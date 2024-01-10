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
        $activeContract = $this->contractUseCase->getActiveContract($userId);
        $plan = $this->planUseCase->getById($planId);

        $contract = $this->contractUseCase->createContract($userId, $plan);
        $this->paymentUseCase->pay(
            $contract['id'],
            $activeContract,
            $plan,
            $price,
            $typeInvoice,
            $typePayment
        );
    }
}
