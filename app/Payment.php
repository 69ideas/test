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

    public static function CountWithFee($amount, $event)
    {
        $t1 = $amount;
        $t2 = $amount;
        if (!$event->vxp_fees) {
            $t1 = round(max(0.2, $amount * 0.005), 2);
        } else {
            $t1 = 0;
        }

        if (!$event->cc_fees) {
            $t2 = round($amount * 0.029, 2) + 0.3;
        } else {
            $t2 = 0;
        }
        return round($t1 + $t2 + $amount, 2);
    }

    public static function CountDonation($amount, $event)
    {
        $t1 = $amount;
        $t2 = $amount;
        if ($event->vxp_fees) {
            $t1 = round(max(0.2, $amount * 0.005), 2);
        } else {
            $t1 = 0;
        }

        if ($event->cc_fees) {
            $t2 = round($amount * 0.029, 2) + 0.3;
        } else {
            $t2 = 0;
        }
        return round($amount - $t1 - $t2, 2);
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
    

}
