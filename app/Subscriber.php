<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email','token',];

    /**
     * Cast the created_at date to a more readably format
     *
     */
    protected $casts = [
        'created_at' => 'datetime:F jS, Y',
    ];
}
