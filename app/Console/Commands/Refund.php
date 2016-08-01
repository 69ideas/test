<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Refund extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paypal:refund';

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
            ->where('status', 'Pending refund')
            ->get()
            ->each(function (\App\Payment $payment) {
                $requestEnvelope = new \PayPal\Types\Common\RequestEnvelope("en_US");
                $paymentDetailsReq = new \PayPal\Types\AP\PaymentDetailsRequest($requestEnvelope);
                $paymentDetailsReq->payKey = $payment->paykey;
                $service = new \PayPal\Service\AdaptivePaymentsService();
                $response = $service->PaymentDetails($paymentDetailsReq);;
                $refunded = false;

                foreach ($response->paymentInfoList->paymentInfo as $payer) {
                    $refunded = $payer->transactionStatus == "REFUNDED" || $refunded;
                }
                if ($refunded) {
                    $payment->status = "Refunded";
                } else {
                    $payment->status = "Completed";
                }
                $payment->save();
            });
    }
}
