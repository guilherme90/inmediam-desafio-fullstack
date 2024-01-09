<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
}
