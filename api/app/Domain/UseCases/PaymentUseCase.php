<?php

namespace App\Domain\UseCases;

use App\Domain\Enums\PaymentStatusEnum;
use App\Domain\Enums\TypeInvoiceEnum;
use App\Domain\Enums\TypePaymentEnum;
use App\Domain\Models\Payment;

class PaymentUseCase
{
    public function pay(
        int $contractId,
        float $priceContracted,
        float $pricePaid,
        TypeInvoiceEnum $typeInvoice,
        TypePaymentEnum $typePayment
    ): int
    {
        $payment = Payment::create([
            'contract_id' => $contractId,
            'price_contracted' => $priceContracted,
            'balance' => 0,
            'price_paid' => $pricePaid,
            'type_invoice' => $typeInvoice->value,
            'type_payment' => $typePayment->value,
            'status' => PaymentStatusEnum::PAID
        ]);

        return 1;
    }
}
