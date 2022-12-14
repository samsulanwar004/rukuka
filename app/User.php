<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'avatar', 'dob', 'gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];


    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

    public function setEmailAttribute($email){
        $this->attributes['email'] = strtolower($email);
    }

    public function creditCards()
    {
        return $this->hasMany(CreditCard::class, 'users_id', 'id')->orderBy('is_default', 'DESC');
    }

    public function address()
    {
        return $this->hasMany(Address::class, 'users_id', 'id')->orderBy('is_default', 'DESC');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'users_id', 'id')->orderBy('id', 'DESC');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'users_id', 'id')->orderBy('id', 'DESC');
    }
}
