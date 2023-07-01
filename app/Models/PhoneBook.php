<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneBook extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
