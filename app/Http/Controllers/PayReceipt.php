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
            $payment->amount = collect($request->get('part'))->sum('amount');

            $payment->method = 'Paypal';
            $payment->status = 'Pending';
            $payment->save();
            foreach ($parts as $item) {
                $participant = new Participant();
                if ($request->get('anonymous')) {
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
                $participant->deposit_type = 'PayPal';
                $participant->vxp_fees = Payment::CountFeeVXP($item['amount'], $event);
                $participant->cc_fees = Payment::CountFeeCC($item['amount'], $event);
                $participant->coordinator_collected = Payment::CountDonation($item['amount'], $event);
                $participant->save();
            }


            $receiver1 = new Receiver();
            $receiver1->email = $event->paypal_email;
            $receiver1->amount = Payment::CountWithFee($payment->amount, $event);
            $receiver1->primary = true;


            $receiver2 = new Receiver();
            $receiver2->email =config('app.admin_email'); 
            $receiver2->amount = Payment::CountFeeVXP($payment->amount, $event, true);
            $receiver2->primary = false;
            $receiverList = new ReceiverList([$receiver1, $receiver2]);
            $payRequest = new PayRequest(new RequestEnvelope("en_US"), 'PAY', route('error'),
                'USD', $receiverList, route('home'));
            $payRequest->feesPayer = 'PRIMARYRECEIVER';


            $payRequest->fundingConstraint = new FundingConstraint();

            $payRequest->fundingConstraint->allowedFundingType = new FundingTypeList();
            $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo = array();
            if ($request->get('type') == 'paypal') {
                $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo[] = new FundingTypeInfo('BALANCE');
            } else {
                $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo[] = new FundingTypeInfo('ECHECK');
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
        foreach ($amounts as $amount) {
            $item = [
                'vxp' => Payment::CountFeeVXP($amount, $event, true),
                'cc' => Payment::CountFeeCC($amount, $event, true),
                'total' => Payment::CountWithFee($amount, $event),
                'donation' => Payment::CountDonation($amount, $event),
            ];
            $response[] = $item;
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

}
