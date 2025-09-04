<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Condition extends Model
{
    use HasTranslations ;
    protected $fillable = [
        'car_id',
        'name',
        'part',
        'description',
        'image'
    ];
    protected $casts = [
        'name' => 'array',
        'part' => 'array',
        'description' => 'array',
    ];
    public $translatable = ['name','part','description'] ;
}
