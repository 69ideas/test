<?php

namespace App\Http\Controllers;

use App\Event;
use App\Participant;
use App\Payment;
use Carbon\Carbon;
use Doctrine\DBAL\Configuration;
use Illuminate\Http\Request;

use App\Http\Requests;
use PayPal\Exception\PPConfigurationException;
use PayPal\Exception\PPConnectionException;
use PayPal\Exception\PPInvalidCredentialException;
use PayPal\Exception\PPMissingCredentialException;
use PayPal\Service\AdaptivePaymentsService;
use PayPal\Types\AP\FundingConstraint;
use PayPal\Types\AP\FundingTypeInfo;
use PayPal\Types\AP\FundingTypeList;
use PayPal\Types\AP\PayRequest;
use PayPal\Types\AP\Receiver;
use PayPal\Types\AP\ReceiverList;
use PayPal\Types\AP\SenderIdentifier;
use PayPal\Types\Common\PhoneNumberType;
use PayPal\Types\Common\RequestEnvelope;


class PayReceipt extends Controller
{
    public function doAction(Requests\PayRequest $request, Event $event)
    {
        $payPalURL = '';
        \DB::transaction(function () use ($request, &$event, &$payPalURL) {
            $parts = collect($request->get('part'));

            $payment = new Payment();

            $payment->name = $parts->first()['name'];
            $payment->email = $parts->first()['email'];
            $payment->amount = 0; // will be calculated later
            $payment->method = 'Paypal';
            $payment->status = 'Pending';
            $payment->event_id = $event->id;
            $payment->save();

            $parts->each(function ($participantInfo) use (&$request, &$payment, &$event) {
                $participant = new Participant();

                if (array_get($participantInfo, 'anonymous', false)) {
                    $participant->name = 'Anonymous';
                } else {
                    $participant->name = $participantInfo['name'];
                    $participant->email = $participantInfo['email'];
                    if (auth()->user()) {
                        $participant->user_id = auth()->id();
                    }
                }

                $participant->participantable()->associate($event);
                $participant->deposit_date = Carbon::now();
                $participant->payment()->associate($payment);
                $participant->save();

                $isPayPal = $request->get('type') == 'paypal';
                $participant->amount_deposited = Payment::CountWithFee($participantInfo['amount'], $event, $isPayPal);
                $participant->cc_fees = Payment::CountFeeCC($participantInfo['amount'], $event, false, $isPayPal);
                $participant->deposit_type = $isPayPal ? 'PayPal' : 'Credit Card';
                $participant->vxp_fees = Payment::CountRealFeeVXP($participantInfo['amount'], $event);
                $vxFee = Payment::CountFeeVXP($participantInfo['amount'], $event);
                $participant->coordinator_collected = $participant->amount_deposited - $vxFee - $participant->cc_fees;
                $participant->save();
                $payment->amount += $participant->amount_deposited;

            });

            $payment->save();


            $receiver1 = new Receiver();
            $receiver1->email = $event->paypal_email;
            $receiver1->amount = $payment->amount;

            $backUrl = route('check', $payment->id);
            $receiverList = new ReceiverList([$receiver1]);
            $payRequest = new PayRequest(new RequestEnvelope("en_US"), 'PAY', $backUrl, 'USD', $receiverList, $backUrl);

            $payRequest->feesPayer = 'EACHRECEIVER';

            if ($request->get('type') == 'paypal') {
                $payRequest->fundingConstraint = new FundingConstraint();
                $payRequest->fundingConstraint->allowedFundingType = new FundingTypeList();
                $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo = [new FundingTypeInfo('BALANCE')];
            }

            $service = new AdaptivePaymentsService();
            try {
                /* wrap API method calls on the service object with a try catch */
                $response = $service->Pay($payRequest);
            } catch (\Exception $ex) {
                echo $this->getDetailedExceptionMessage($ex);
                exit;
            }
            $token = $response->payKey;
            $payment->paykey = $token;
            $payment->save();
            $payPalURL = PAYPAL_REDIRECT_URL . '_ap-payment&paykey=' . $token;

        });

        return response()->json(['redirect' => $payPalURL]);
    }

    protected function getDetailedExceptionMessage($ex)
    {
        if ($ex instanceof PPConnectionException) {
            return "Error connecting to " . $ex->getUrl();
        } else {
            if ($ex instanceof PPConfigurationException) {
                return "Error at $ex->getLine() in $ex->getFile()";
            } else {
                if ($ex instanceof PPInvalidCredentialException || $ex instanceof PPMissingCredentialException) {
                    return $ex->errorMessage();
                }
            }
        }

        return "";
    }

    public function payment_total(Request $request)
    {
        $amounts = json_decode($request->get('amounts', '[]'), true);
        $event = Event::find($request->get('event'));

        $response = collect($amounts)->reject(function ($amount) {
            return $amount == 0;
        })
            ->map(function ($amount, $key) use ($event, $request) {
                $item = [
                    'mid'   => $key + 1,
                    'vxp'   => Payment::CountFeeVXP($amount, $event, true),
                    'total' => Payment::CountWithFee($amount, $event, $request->input('type') == 'false'),
                    'cc'    => $request->input('type') != 'false' ? Payment::CountFeeCC($amount, $event, true) : 0,
                ];

                $item['donation'] = $item['total'] - $item['vxp'] - $item['cc'];

                return $item;
            })->all();
        return view('frontend.total_payment', compact('response'));
    }


    public function another_entry(Request $request)
    {
        $event = Event::find($request->get('event'));
        $id = $request->get('id');

        return view('frontend.another_entry', compact('event', 'id'));
    }

    public function pay_fee(Event $event)
    {
        $payPalURL = '';

        \DB::transaction(function () use ($event, &$payPalURL) {

            $payment = new Payment();
            $payment->name = config('app.admin_email');
            $payment->email = config('app.admin_email');

            $payment->amount = abs($event->CountFees());

            $payment->method = 'Fees';
            $payment->status = 'Pending';
            $payment->event_id = $event->id;
            $payment->save();
            $event->payment_id = $payment->id;
            $event->save();

            $receiver2 = new Receiver();
            $receiver2->email = config('app.admin_email');
            $receiver2->amount = abs($event->CountFees());

            $list = [$receiver2];

            $receiverList = new ReceiverList($list);
            $payRequest = new PayRequest(new RequestEnvelope("en_US"), 'PAY', route('check', $payment->id),
                'USD', $receiverList, route('check', $payment->id));
            $payRequest->feesPayer = 'SENDER';

            $payRequest->fundingConstraint = new FundingConstraint();
            $payRequest->fundingConstraint->allowedFundingType = new FundingTypeList();
            $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo = [new FundingTypeInfo('BALANCE')];

            $service = new AdaptivePaymentsService();
            try {
                $response = $service->Pay($payRequest);
            } catch (\Exception $ex) {
                echo $this->getDetailedExceptionMessage($ex);
                exit;
            }
            $token = $response->payKey;
            $payment->paykey = $token;
            $payment->save();
            $payPalURL = PAYPAL_REDIRECT_URL . '_ap-payment&paykey=' . $token;

        });

        return redirect($payPalURL);

    }

    public function check($id)
    {
        $payment = \App\Payment::find($id);
        $requestEnvelope = new \PayPal\Types\Common\RequestEnvelope("en_US");
        $paymentDetailsReq = new \PayPal\Types\AP\PaymentDetailsRequest($requestEnvelope);
        $paymentDetailsReq->payKey = $payment->paykey;
        $service = new \PayPal\Service\AdaptivePaymentsService();
        $response = $service->PaymentDetails($paymentDetailsReq);
        if ($response->status == 'COMPLETED') {
            $payment->status = 'Completed';
            $payment->save();
        } elseif (in_array($response->status, ['ERROR', 'EXPIRED'])) {
            $payment->status = 'Failed';
            $payment->save();
        } elseif (in_array($response->status, ['REVERSALERROR', 'INCOMPLETE'])) {
            $email = config('app.admin_email');
            \Mail::queue('frontend.emails.failed', compact( 'email'),
                function (\Illuminate\Mail\Message $message) use ($email) {
                    $message->to($email)
                        ->subject('Whops!');
                });
        }
        return redirect()->route('event.index');
    }


}
