<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedSearch extends Model
{
    //
    protected $guarded = [];
    protected $table = 'saved_searches';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
