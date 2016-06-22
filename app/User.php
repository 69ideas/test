<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'bank_account_verified',
        'phone',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip_code',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function getFullNameAttribute(){
        $full_name=$this->first_name.' '.$this->last_name;
        return $full_name;
    }

    public function scopeOrderByName(Builder $builder)
    {
        return $builder
            ->orderBy('first_name')
            ->orderBy('last_name');
    }

    public function getIsCloseAttribute()
    {
        return $this->closed_date < new Carbon();
    }
}
