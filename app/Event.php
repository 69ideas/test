<?php

namespace App;

use App\Traits\ImageCast;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use ImageCast;
    use SluggableTrait;
    protected $sluggable = [
        'build_from' => 'title',
    ];
    public function getRouteKeyName(){
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
        'title','deadline', 'description', 'sort_order', 'seo_keywords', 'seo_description', 'seo_title', 'user_id',
        'start_date','closed_date','short_description','is_show','allow_anonymous'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dates = ['start_date', 'closed_date','deadline'];

    public function setStartDateAttribute($value = null)
    {
        $this->attributes['start_date'] = is_object($value) ? $value : \Carbon\Carbon::createFromFormat('m/d/Y', $value);
    }
    public function formStartDateAttribute($value)
    {
        return $value->format('m/d/Y');
    }
    public function setClosedDateAttribute($value = null)
    {
        $this->attributes['closed_date'] = is_object($value) ? $value : \Carbon\Carbon::createFromFormat('m/d/Y', $value);
    }

    public function formClosedDateAttribute($value)
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
}
