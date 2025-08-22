<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'type',
        'sent_at',
        'user_id',
        'is_read',
        'topic'
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'is_read' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($notification) {
            $notification->sent_at = $notification->sent_at ?? now();
        });
    }

    /**
     * Scope a query to only include unread notifications.
     */
    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('is_read', false);
    }

    /**
     * Get the user that the notification belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}