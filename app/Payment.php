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
        $amount = $this->amount+$this->amount_2;

        return static::CountWithFee($amount, $event);
    }

    public static function CountWithFee($amount, $event)
    {
     
        if (!$event->vxp_fees) {
            $amount += 0.15;
        }

        if (!$event->cc_fees) {
            $amount /= (1 - 0.032);
        }

        return round($amount,2);
    }

}
