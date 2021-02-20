<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $dates = [
        'limit_at',
        'deleted_at'
    ];

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

    public function project(): BelongsTo
    {
        return $this->belongsTo('App\Project');
    }

    public function getLimitAtAttribute($value)
    {
        // limit_atをyyyy/mm/dd hh:mm形式で取得する
        return $value ? Carbon::parse($value)->format('Y/m/d H:i') : null;
    }
}
