<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'title',
        'status',
        'limit_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
