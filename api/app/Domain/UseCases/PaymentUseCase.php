<?php

namespace App\Domain\UseCases;

use App\Domain\Enums\PaymentStatusEnum;
use App\Domain\Models\Payment;
use App\Domain\Models\Contract;
use App\Domain\Models\Plan;
use App\Traits\CalculateBalanceTrait;

class PaymentUseCase
{
    use CalculateBalanceTrait;

    public function pay(
        int $contractId,
        ?Contract $activeContract,
        Plan $plan,
        float $pricePaid,
        string $typeInvoice,
        string $typePayment
    ): void
    {
        $planPrice = $plan['price'];

        if (!$activeContract) {
            Payment::create([
                'contract_id' => $contractId,
                'price_contracted' => $planPrice,
                'balance' => 0,
                'price_paid' => $pricePaid,
                'type_invoice' => $typeInvoice,
                'type_payment' => $typePayment,
                'status' => PaymentStatusEnum::PAID
            ]);
            return;
        }

        $outstandingBalance = $this->getOutstandingBalance($planPrice);

        if ($planPrice > $activeContract['price']) {
            Payment::create([
                'contract_id' => $contractId,
                'price_contracted' => $planPrice,
                'balance' => -$outstandingBalance,
                'price_paid' => 0,
                'type_invoice' => $typeInvoice,
                'type_payment' => null,
                'status' => PaymentStatusEnum::PENDING
            ]);
            return;
        }

        if ($planPrice < $activeContract['price']) {
            Payment::create([
                'contract_id' => $contractId,
                'price_contracted' => $planPrice,
                'balance' => $outstandingBalance,
                'price_paid' => $planPrice,
                'type_invoice' => 'credit',
                'type_payment' => $typePayment,
                'status' => PaymentStatusEnum::PENDING
            ]);
        }
    }
}
