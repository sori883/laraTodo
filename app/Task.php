<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'status',
        'limit_at',
        'project_id'
    ];

    protected $attributes = [
        "status" => null,
        "limit_at" => null,
        "project_id" => null,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
