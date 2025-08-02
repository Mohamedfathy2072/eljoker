<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'car_id',
        'user_id',
        'address',
        'appointment_date',
        'appointment_time'
    ];
}
