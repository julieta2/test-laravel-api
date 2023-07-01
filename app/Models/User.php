<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    public function country()
    {
        return $this->hasOne('App\Models\UserCountry');
    }

    public function phoneBook()
    {
        return $this->hasOne('App\Models\PhoneBook');
    }
}
