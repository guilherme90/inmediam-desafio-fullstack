<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $hidden = [
        'deleted_at', 'updated_at'
    ];
}
