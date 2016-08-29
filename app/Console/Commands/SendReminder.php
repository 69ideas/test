<?php

namespace App\Console\Commands;

use App\Event;
use Illuminate\Console\Command;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paypal:fees';

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
        \App\Event::where('payment_id', null)
        ->get()
        ->each(function (\App\Event $event){
            $email=$event->user->email;
            $user=$event->user;
            if ($event->payment_id==null){
            \Mail::queue('frontend.emails.reminder', compact('event', 'email','user'),
                function (\Illuminate\Mail\Message $message) use ($email) {
                    $message->to($email)
                        ->subject('Event Commission');
                });
            }
            else {
                if ($event->status!='Completed'){
                    \Mail::queue('frontend.emails.reminder', compact('event', 'email','user'),
                        function (\Illuminate\Mail\Message $message) use ($email) {
                            $message->to($email)
                                ->subject('Event Commission');
                        });
                }
            }


        });
    }
}
