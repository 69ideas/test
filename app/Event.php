<?php

namespace App;

use App\Http\Controllers\Admin\Participants;
use App\Traits\ImageCast;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Mail\Message;

class Event extends Model implements SluggableInterface
{
    use ImageCast;
    use SluggableTrait;
    protected $sluggable = [
        'build_from' => 'short_description',
        'on_update' => true,
    ];

    public static function boot()
    {
        parent::boot();
        self::updated(function (Event $event) {
            $event
                ->participants
                ->reject(function (Participant $participant) {
                    return is_null($participant->email);
                })
                ->unique('email')
                ->each(function (Participant $participant) use ($event)
                {

                    $email = $participant->email;
                    \Mail::queue('frontend.emails.change', compact('event', 'participant'),
                        function (Message $message) use ($email, $event) {
                            $message->to($email)
                                ->subject('Event was changed');
                        });
                });
            
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPhotoAttribute()
    {
        return $this->_cast_image($this->attributes['image']);
    }

    public function getPublicPhotoAttribute()
    {
        $path = $this->_cast_image_public($this->attributes['image']);

        return $path;
    }

    protected $fillable = [
        'vxp_fees',
        'cc_fees',
        'number_participants',
        'is_close',
        'needable_sum',
        'deadline',
        'description',
        'sort_order',
        'seo_keywords',
        'seo_description',
        'seo_title',
        'user_id',
        'start_date',
        'short_description',
        'allow_anonymous',
        'paypal_email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dates = ['start_date', 'closed_date', 'deadline'];

    public function setStartDateAttribute($value = null)
    {
        $this->attributes['start_date'] = is_object($value) ? $value : \Carbon\Carbon::createFromFormat('m/d/Y',
            $value);
    }

    public function formStartDateAttribute($value)
    {
        return $value->format('m/d/Y');
    }

    public function setDeadlineAttribute($value = null)
    {
        $this->attributes['deadline'] = is_object($value) ? $value : \Carbon\Carbon::createFromFormat('m/d/Y', $value);
    }

    public function formDeadlineAttribute($value)
    {
        return $value->format('m/d/Y');
    }

    public function participants()
    {
        return $this->morphMany(Participant::class, 'participantable');

    }
    public function payed_participants()
    {
        return $this->morphMany(Participant::class, 'participantable')
            ->where(function(Builder $builder){
                $builder->whereNull('payment_id')
                    ->orWhereHas('payment', function (Builder $builder){
                        $builder->where('status', 'Completed');
                    });
            });

    }

    public function getIsCloseAttribute()
    {
        return $this->closed_date > new Carbon();
    }


    public function getVaultXCollectedAttribute()
    {
        return $this->payed_participants->sum('vxp_fees');
    }

    public function getCoordinatorCollectedAttribute()
    {
        return $this->payed_participants->sum('coordinator_collected');
    }

    public function getCommissionAttribute()
    {
        return $this->payed_participants->sum('cc_fees');

    }

    public function getTotalAttribute()
    {
        return $this->payed_participants->sum('amount_deposited');

    }

    public function getCurrentUserCollectedAttribute()
    {
        $total = 0;
        foreach ($this->payed_participants()->where('user_id', \Auth::user()->id)->get() as $participant) {
            $total = $total + $participant->amount_deposited;
        };
        return $total;
    }

    public function isCoordinator($user)
    {
        if(is_null($user))
            return false;

        return $this->user_id == $user->id;
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class)
            ->where('status','<>','Failed');
    }

    public function CountFees(){
        $payments=Payment::where('event_id',$this->id)->where('status','Completed')->get();
        $sum=0;
        foreach ($payments as $payment){
            if ($payment->method=='Fees'){
                $sum=$sum-$payment->amount;
            }
            else{
                $sum=$sum+ round(max(0.2, $payment->amount * 0.005), 2);
            }
        }
        return $sum;
    }

}
