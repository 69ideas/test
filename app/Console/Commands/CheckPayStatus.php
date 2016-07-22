<?php

namespace App\Console\Commands;

use App\Payment;
use Illuminate\Console\Command;
use PayPal\Service\AdaptivePaymentsService;
use PayPal\Types\AP\PaymentDetailsRequest;
use PayPal\Types\Common\RequestEnvelope;

class CheckPayStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paypal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \App\Payment::whereNotNull('paykey')
            ->where('status', 'Pending')
            ->get()
            ->each(function (\App\Payment $payment){

                $requestEnvelope = new \PayPal\Types\Common\RequestEnvelope("en_US");
                $paymentDetailsReq = new \PayPal\Types\AP\PaymentDetailsRequest($requestEnvelope);
                $paymentDetailsReq->payKey = $payment->paykey;
                $service = new \PayPal\Service\AdaptivePaymentsService();
                $response = $service->PaymentDetails($paymentDetailsReq);
                if($response->status == 'COMPLETED')
                {
                    $payment->status = 'Completed';
                    $payment->save();
                }
                elseif (in_array($response->status, ['ERROR','EXPIRED']))
                {
                    $payment->status = 'Failed';
                    $payment->save();
                }
                elseif (in_array($response->status, ['REVERSALERROR','INCOMPLETE']))
                {
                    $email=config('app.admin_email');
                    \Mail::queue('frontend.emails.failed', compact('event','email'), function (\Illuminate\Mail\Message $message) use ($email) {
                        $message->to($email)
                            ->subject('Whops!');
                    });
                }
            });

    }
}
