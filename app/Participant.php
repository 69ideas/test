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
        return ($this->amount_deposited - $this->vxp_fees * $this->commission) * !$this->is_hands_payment;
    }

    public function  getCoordinatorCollectedAttribute()
    {
        return ($this->amount_deposited - $this->cc_fees * $this->commission ) * $this->is_hands_payment;
    }

    public function  getCommissionAttribute()
    {
        return (0.15 + (0.032 * $this->amount_deposited)) * (!$this->is_hands_payment);
    }

    public function  getTotalAttribute()
    {
        return $this->vault_x_collected + $this->coordinator_collected + $this->commission;
    }
}
