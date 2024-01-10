<?php

namespace App\Domain\UseCases;

class HirePlanUseCase
{
    public function __construct(
        private readonly ContractUseCase $contractUseCase,
        private readonly PaymentUseCase $paymentUseCase,
        private readonly PlanUseCase $planUseCase
    )
    {}

    public function process(
        int $userId,
        int $planId,
        float $price,
        string $typeInvoice,
        string $typePayment
    ): void
    {
        $contract = $this->contractUseCase->getActiveContract($userId);
        $plan = $this->planUseCase->getById($planId);

        $contractId = $this->contractUseCase->createContract($userId, $plan);
        $this->paymentUseCase->pay(
            $contractId,
            $contract,
            $plan,
            $price,
            $typeInvoice,
            $typePayment
        );
    }
}
