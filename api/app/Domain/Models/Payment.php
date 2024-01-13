<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
      'contract_id', 'price_contracted', 'balance', 'price_paid', 'type_invoice', 'type_payment', 'status'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }
}
