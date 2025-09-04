<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Feature extends Model
{
    use HasTranslations;
    
    protected $fillable = [
        'car_id',
        'name',
        'label',
        'value',
    ];

    public $translatable = ['name','label', 'value'];
    
    /**
     * Get the car that owns the feature.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
