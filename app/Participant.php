<?php

namespace App;

use App\Traits\TTabbed;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use TTabbed;
    protected $fillable = [
        'user_id','deposit_type', 'amount_deposited', 'deposit_date',
    ];
    protected $dates = ['deposit_date'];

    public function setDepositDateAttribute($value = null)
    {
        $this->attributes['deposit_date'] = is_object($value) ? $value : \Carbon\Carbon::createFromFormat('m/d/Y', $value);
    }

    public function formDepositDateAttribute($value)
    {
        return $value->format('m/d/Y');
    }
    public function participantable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }


    public function getIsHandsPaymentAttribute()
    {
        return ($this->deposit_type == 'Cash');
    }

    public function  getVaultXCollectedAttribute()
    {
        //return ($this->amount_deposited - $this->vxp_fees * $this->commission) * !$this->is_hands_payment;
        return 0.15;
    }

    public function  getCoordinatorCollectedAttribute()
    {
       $event=Event::where('id',$this->participantable_id)->first();

        $amount=$this->amount_deposited;
        if ($event->vxp_fees) {
            $amount -= 0.15;
        }

        if ($event->cc_fees) {
            $amount *= (1 - 0.032);
        }
        return $amount;
        //return ($this->amount_deposited - $this->commission );

    }

    public function  getCommissionAttribute()
    {
        return (0.032 * $this->amount_deposited);
    }

    public function  getTotalAttribute()
    {
        return $this->amount_deposited;
    }
}
