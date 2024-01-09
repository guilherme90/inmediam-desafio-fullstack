<?php

namespace App\Domain\Enums;

enum TypeInvoiceEnum: string
{
    case DEBIT = 'debit';
    case CREDIT = 'credit';
}
