<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
      'contract_id', 'price_contracted', 'balance', 'price_paid', 'type_invoice', 'type_payment', 'status'
    ];
}
