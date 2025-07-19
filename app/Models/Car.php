<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'model_year',
        'body_style',
        'type',
        'fuel_type',
        'transmission_type',
        'drive_type',
        'color',
        'mileage',
        'speed',
        'vehicle_status',
        'refurbishment_status',
        'price',
        'discount',
        'monthly_installment',
        'category',
    ];


}
