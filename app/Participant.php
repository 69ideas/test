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
}
