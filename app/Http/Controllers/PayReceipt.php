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
        \DB::transaction(function () use ($request, $event, &$payPalURL) {
            $payment = new Payment();
            $parts = $request->get('part');
            $payment->name = $parts[0]['name'];
            $payment->email = $parts[0]['email'];
            $payment->amount = collect($request->get('part'))
                ->map(function ($item, $key) {
                    return str_replace(',', '', $item['amount']);
                })
                ->sum();
            $payment->method = 'Paypal';
            $payment->status = 'Pending';
            $payment->event_id = $event->id;
            $payment->save();
            foreach ($parts as $item) {
                $participant = new Participant();
                if (array_get($item, 'anonymous', false) == true) {
                    $participant->name = 'Anonymous';
                } else {
                    $participant->name = $item['name'];
                    $participant->email = $item['email'];
                    if (\Auth::user()) {
                        $participant->user_id = \Auth::user()->id;
                    }
                }
                $participant->participantable()->associate($event);
                $participant->deposit_date = Carbon::now();
                $participant = $participant->payment()->associate($payment);
                $participant->save();

                $participant->amount_deposited = Payment::CountWithFee($item['amount'], $event);

                $participant->deposit_type = 'Credit Card';
                $participant->vxp_fees = Payment::CountFeeVXP($item['amount'], $event);
                $participant->cc_fees = Payment::CountFeeCC($item['amount'], $event);
                $participant->coordinator_collected = Payment::CountDonation($item['amount'], $event);
                $participant->save();
            }


            $receiver1 = new Receiver();
            $receiver1->email = $event->paypal_email;

            $receiver1->amount = $payment->amount;

            $list = [$receiver1];

            $receiverList = new ReceiverList($list);
            $payRequest = new PayRequest(new RequestEnvelope("en_US"), 'PAY', route('error'),
                'USD', $receiverList, route('check', $payment->id));

            if ($event->cc_fees) {
                $payRequest->feesPayer = 'EACHRECEIVER';
            } else {
                $payRequest->feesPayer = 'SENDER';
            }
            //
            //$payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo[] = new FundingTypeInfo('CREDITCARD');

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

    function getDetailedExceptionMessage($ex)
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

    public
    function payment_total(
        Request $request
    ) {
        $amounts = json_decode($request->get('amounts', '[]'), true);
        $event = Event::find($request->get('event'));
        $response = [];
        $mid = 1;
        foreach ($amounts as $amount) {
            if ($amount != 0) {
                $amount = str_replace(',', '', $amount);
                $item = [
                    'mid' => $mid,
                    'vxp' => Payment::CountFeeVXP($amount, $event, true),
                    'cc' => Payment::CountFeeCC($amount, $event, true),
                    'total' => Payment::CountWithFee($amount, $event),
                    'donation' => Payment::CountDonation($amount, $event),
                ];
                if ($request->get('type') == 'false' && $event->cc_fees == false) {

                    $item['donation'] = $item['donation'] + $item['cc'];
                    $item['cc'] = 0;

                }

                $mid = $mid + 1;
                $response[] = $item;
            }
        }

        return view('frontend.total_payment',
            compact('response'));
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
            $payment->amount = $event->CountFees();

            $payment->method = 'Fees';
            $payment->status = 'Pending';
            $payment->event_id = $event->id;
            $payment->save();
            $event->payment_id = $payment->id;
            $event->save();

            $receiver2 = new Receiver();
            $receiver2->email = config('app.admin_email');
            $receiver2->amount = $event->CountFees();

            $list = [$receiver2];

            $receiverList = new ReceiverList($list);
            $payRequest = new PayRequest(new RequestEnvelope("en_US"), 'PAY', route('error'),
                'USD', $receiverList, route('check', $payment->id));
            $payRequest->feesPayer = 'EACHRECEIVER  ';


            //
            //$payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo[] = new FundingTypeInfo('CREDITCARD');

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
            \Mail::queue('frontend.emails.failed', compact('event', 'email'),
                function (\Illuminate\Mail\Message $message) use ($email) {
                    $message->to($email)
                        ->subject('Whops!');
                });
        }
        return redirect()->route('event.index');
    }


}
