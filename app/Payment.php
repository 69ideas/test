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

    public static function CountWithFee($amount, $event, $paypal = false)
    {
        $total = $amount;
        $total += self::CountFeeCC($amount, $event, false, $paypal);
        $total += self::CountFeeVXP($amount, $event, false, $paypal);

        return $total;
    }

    public static function CountDonation($amount, $event, $paypal = false)
    {
        $total = self::CountWithFee($amount, $event, $paypal);
        $total -= self::CountFeeCC($amount, $event, true, $paypal);
        $total -= self::CountFeeVXP($amount, $event, true);

        return round($total, 2);
    }


    public static function CountFeeVXP($amount, $event, $force = false, $paypal = false)
    {
        if (!$event->vxp_fees || $force) {
            $vxp = round(max(0.2, $amount * 0.005), 2);
        } else {
            $vxp = 0;
        }
        return round($vxp, 2);
    }

    public static function CountRealFeeVXP($amount, $event, $force = false, $paypal = false)
    {
        $paidByCustomer = self::CountWithFee($amount, $event, $paypal);
        $actualPayPalFee = self::PPFee($paidByCustomer);
        $actualDonation = self::CountDonation($amount, $event, $paypal);

        return round($paidByCustomer - $actualDonation - $actualPayPalFee, 2);
    }

    public static function CountFeeCC($amount, $event, $force = false, $paypal = false)
    {
        if ((!$paypal && !$event->cc_fees) || $force) {
            return self::PPFee($amount);
        }

        return round(0, 2);
    }

    protected static function PPFee($amount)
    {
        return round($amount * 0.029 + 0.3, 2);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
