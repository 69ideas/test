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

define('PAYPAL_REDIRECT_URL', 'https://www.sandbox.paypal.com/webscr&cmd=');
define("DEFAULT_SELECT", "- Select -");
define('PP_CONFIG_PATH', config_path());

class PayReceipt extends Controller
{
    public function doAction(Requests\PayRequest $request, Event $event)
    {
        $payment = new Payment();
        $payment->name = $request->get('name');
        $payment->email = $request->get('email');
        $payment->amount = $request->get('amount') + $request->get('amount_2');
        $payment->method = 'Paypal';
        $payment->status = 'Pending';
        $payment->save();

        if (!$request->get('another_entry')) {
            $participant = new Participant();
            if ($request->get('anonymous')) {
                $participant->name = 'Anonymous';
            } else {
                $participant->name = $request->get('name');
                $participant->email = $request->get('email');
                if (\Auth::user()) {
                    $participant->user_id = \Auth::user()->id;
                }
            }
            $participant->participantable()->associate($event);
            $participant->deposit_type = 'Paypal';
            $participant->deposit_date = Carbon::now();

            $participant = $participant->payment()->associate($payment);
            $participant->save();
            $participant->amount_deposited = $payment->amount_with_fees;
            $participant->vxp_fees = 0.15;
            $participant->cc_fees = 0.032 * $payment->amount_with_fees;
            if (!$event->vxp_fees && !$event->cc_fees) {
                $participant->coordinator_collected = $payment->amount;
            } elseif (!$event->vxp_fees && $event->cc_fees) {
                $participant->coordinator_collected = $payment->amount - $participant->cc_fees;
            } elseif ($event->vxp_fees && !$event->cc_fees) {
                $participant->coordinator_collected = $payment->amount - $participant->vxp_fees;
            } elseif ($event->vxp_fees && $event->cc_fees) {
                $participant->coordinator_collected = $payment->amount - $participant->vxp_fees - $participant->cc_fees;
            }
            $participant->save();

        } else {
            $participant = new Participant();
            if ($request->get('anonymous')) {
                $participant->name = 'Anonymous';
            } else {
                $participant->name = $request->get('name');
                $participant->email = $request->get('email');
                if (\Auth::user()) {
                    $participant->user_id = \Auth::user()->id;
                }
            }
            $participant->participantable()->associate($event);
            $participant->deposit_type = 'Paypal';
            $participant->deposit_date = Carbon::now();
            $participant = $participant->payment()->associate($payment);
            $participant->save();
            $participant->amount_deposited = Payment::CountWithFee($request->get('amount'), $event);
            $participant->vxp_fees = 0.3;
            $participant->cc_fees = 0.032 * $participant->amount_deposited;
            if (!$event->vxp_fees && !$event->cc_fees) {
                $participant->coordinator_collected = $request->get('amount');
            } elseif (!$event->vxp_fees && $event->cc_fees) {
                $participant->coordinator_collected = $request->get('amount') - $participant->cc_fees;
            } elseif ($event->vxp_fees && !$event->cc_fees) {
                $participant->coordinator_collected = $request->get('amount') - $participant->vxp_fees;
            } elseif ($event->vxp_fees && $event->cc_fees) {
                $participant->coordinator_collected = $request->get('amount') - $participant->vxp_fees - $participant->cc_fees;
            }
            $participant->save();

            $participant = new Participant();
            if ($request->get('anonymous')) {
                $participant->name = 'Anonymous';
            } else {
                $participant->name = $request->get('name_2');
                $participant->email = $request->get('email_2');
                if (\Auth::user()) {
                    $participant->user_id = \Auth::user()->id;
                }
            }
            $participant->participantable()->associate($event);
            $participant->deposit_type = 'Paypal';
            $participant->deposit_date = Carbon::now();
            $participant = $participant->payment()->associate($payment);
            $participant->save();
            $participant->amount_deposited = Payment::CountWithFee($request->get('amount_2'), $event);
            $participant->vxp_fees = 0.15;
            $participant->cc_fees = 0.032 * $participant->amount_deposited;
            if (!$event->vxp_fees && !$event->cc_fees) {
                $participant->coordinator_collected = $request->get('amount_2');
            } elseif (!$event->vxp_fees && $event->cc_fees) {
                $participant->coordinator_collected = $request->get('amount_2') - $participant->cc_fees;
            } elseif ($event->vxp_fees && !$event->cc_fees) {
                $participant->coordinator_collected = $request->get('amount_2') - $participant->vxp_fees;
            } elseif ($event->vxp_fees && $event->cc_fees) {
                $participant->coordinator_collected = $request->get('amount_2') - $participant->vxp_fees - $participant->cc_fees;
            }
            $participant->save();

        }


        $receiver1 = new Receiver();
        $receiver1->email = $event->paypal_email;
        $receiver1->amount = $payment->amount_with_fees;
        $receiver1->primary = true;


        $receiver2 = new Receiver();
        $receiver2->email = 'vaultx-admin@ananas-web.ru'; //@todo @nisshen Move to config or admin
        $receiver2->amount = 0.15;
        $receiver2->primary = false;
        $receiverList = new ReceiverList([$receiver1, $receiver2]);
        $payRequest = new PayRequest(new RequestEnvelope("en_US"), 'PAY', route('error'),
            'USD', $receiverList, route('home'));
        $payRequest->feesPayer = 'PRIMARYRECEIVER';


        $payRequest->fundingConstraint = new FundingConstraint();

        $payRequest->fundingConstraint->allowedFundingType = new FundingTypeList();
        $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo = array();
        $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo[] = new FundingTypeInfo('ECHECK');
        $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo[] = new FundingTypeInfo('BALANCE');
        $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo[] = new FundingTypeInfo('CREDITCARD');


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
        return redirect($payPalURL);
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
        $event = Event::find($request->get('event'));
        $total_1=Payment::CountWithFee($request->get('amount'), $event);
        $total_2=Payment::CountWithFee($request->get('amount_2'), $event);
        $total = $total_1+$total_2;
        if (!$event->cc_fees){
            $cc_fees_1=round($total_1*0.032,2);
            $cc_fees_2=round($total_2*0.032,2);
        }
        else {
            $cc_fees_1=round(0,2);
            $cc_fees_2=round(0,2);
        }
        if (!$event->vxp_fees){
            $vxp_fees_1=0.15;
            if($request->get('amount_2')>0){
                $vxp_fees_2=0.15;
            } else {
                $vxp_fees_2=round(0,2);
            }

        }
        else {
            $vxp_fees_1=round(0,2);
            $vxp_fees_2=round(0,2);
        }
        if ($request->get('amount_2')>0){
            $other=1;
        } else{
            $other=0;
        }
        return view('frontend.total_payment', compact('other','total','event','total_1','total_2','cc_fees_1','cc_fees_2','vxp_fees_1','vxp_fees_2'));
    }

    public
    function another_entry(
        Request $request
    ) {
        return view('frontend.another_entry');
    }

}
