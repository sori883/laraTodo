<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function task(): hasMany
    {
        return $this->hasMany('App\Task');
    }
}
