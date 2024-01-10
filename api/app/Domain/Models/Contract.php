<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Contract extends Model
{
    protected $fillable = [
        'user_id', 'plan_id', 'price', 'active'
    ];

    public function scopeIsActive(Builder $query, int $userId): void
    {
        $query->where('active', '=', 'true')->where('user_id', '=', $userId);
    }
}
