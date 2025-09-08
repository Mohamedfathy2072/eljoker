<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class CarModel extends Model
{
    use HasFactory ,HasTranslations;
    protected $fillable = ['name','brand_id'];
    public $translatable = ['name'];
    protected $casts = [
        'name' => 'array',
    ];
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
