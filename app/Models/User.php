<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name_en',
        'name_ar',
        'email',
        'otp_hash',
        'otp_expires_at',
        'is_active',
        'phone'
    ];
    
    /**
     * Get the user's name based on current application locale
     *
     * @return string|null
     */
    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        $nameField = 'name_' . $locale;
        return $this->attributes[$nameField] ?? $this->attributes['name_en'] ?? null;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
    public function favouriteCars()
    {
        return $this->belongsToMany(Car::class, 'car_user_favourites')->withTimestamps();
    }
}
