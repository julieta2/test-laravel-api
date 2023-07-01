<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCountry extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
