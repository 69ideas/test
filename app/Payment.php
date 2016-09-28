<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function participant()
    {
        return $this->hasOne(Participant::class);
    }

    public function getAmountWithFeesAttribute()
    {
        $event = $this->participant->participantable;
        if ($this->amount_2 > 0) {
            $amount = static::CountWithFee($this->amount, $event) + static::CountWithFee($this->amount_2, $event);
        } else {
            $amount = static::CountWithFee($this->amount, $event);
        }
        return $amount;
    }

    public static function CountWithFee($amount, $event, $paypal=false)
    {
        if($paypal==true){
            if ($event->vxp_fees){
                $total=$amount;
            }
            else{
                $total=$amount+round(max(0.2, $amount * 0.005), 2);
            }
        }
        else{
        if ($event->cc_fees){
            if ($event->vxp_fees){
                $total=$amount;
            }
            else{
                $total=$amount+round(max(0.2, $amount * 0.005), 2);
            }
        }
        else{
            if ($event->vxp_fees){
                $total=($amount+0.3)/(1-0.029);
            }
            else{
                $total=($amount+max(0.2, $amount * 0.005)+0.3)/(1-0.029);
            }
        }
        }
        return round($total, 2);
    }

    public static function CountDonation($amount, $event,$paypal=false)
    {
        if ($event->cc_fees){
           if ($event->vxp_fees){
               $total=$amount;
           }
           else{
               $total=$amount+round(max(0.2, $amount * 0.005), 2);
           }
       }
       else{
           if ($event->vxp_fees){
               $total=($amount+0.3)/(1-0.029);
           }
           else{
               $total=($amount+max(0.2, $amount * 0.005)+0.3)/(1-0.029);
           }
       }

        return round($total, 2);
    }


    public static function CountFeeVXP($amount, $event, $force = false){
        if (!$event->vxp_fees || $force) {
            $vxp = round(max(0.2, $amount * 0.005), 2);
        } else {
            $vxp = 0;
        }
        return round($vxp,2);
    }
    public static function CountFeeCC($amount, $event, $force = false){
        if (!$event->cc_fees || $force) {
            $cc = round($amount * 0.029, 2) + 0.3;
        } else {
            $cc = 0;
        }
        return round($cc,2);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
