<?php

namespace App\Domain\Enums;

enum TypePaymentEnum: string
{
    case PIX = 'pix';
    case CREDIT_CARD = 'credit_card';
    case BILLET = 'billet';
}
