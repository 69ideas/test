<?php

namespace App;

use App\Traits\ImageCast;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Event extends Model implements SluggableInterface
{
    use ImageCast;
    use SluggableTrait;
    protected $sluggable = [
        'build_from' => 'short_description',
        'on_update'  => true,
    ];

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

    public function getIsCloseAttribute()
    {
        return $this->closed_date >  new Carbon();
    }


    public function getVaultXCollectedAttribute()
    {
        return $this->participants->sum('vault_x_collected');
    }

    public function getCoordinatorCollectedAttribute()
    {
        return $this->participants->sum('coordinator_collected');
    }

    public function getCommissionAttribute()
    {
        return $this->participants->sum('commission');

    }

    public function getTotalAttribute()
    {
        return $this->participants->sum('total');

    }
    public function getCurrentUserCollectedAttribute(){
        $total=0;
       foreach ($this->participants()->where('user_id',\Auth::user()->id)->get() as $participant){
           $total=$total+$participant->amount_deposited;
       };
        return $total;
    }

}
