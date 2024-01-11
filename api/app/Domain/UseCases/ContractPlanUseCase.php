<?php

namespace App\Domain\UseCases;

use App\Domain\Enums\PaymentStatusEnum;
use App\Domain\Models\Contract;
use App\Domain\Models\Payment;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ContractPlanUseCase
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
        $activeContract = Contract::isActive($userId)->first();
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

    public function pay(int $userId, int $contractId): void
    {
        $activeContract = Contract::isActive($userId)->first();

        if (!$activeContract) {
            throw new HttpException(404, 'Contrato não encontrado');
        }

        $paymentPending = Payment::query()
            ->where('contract_id', $contractId)
            ->where('status',PaymentStatusEnum::PENDING)
            ->first();

        Payment::create([
            'parent_id' => $paymentPending['id'],
            'contract_id' => $contractId,
            'price_contracted' => $paymentPending['price_contracted'],
            'balance' => 0,
            'price_paid' => abs($paymentPending['balance']),
            'type_invoice' => 'debit',
            'type_payment' => 'pix',
            'status' => PaymentStatusEnum::PAID
        ]);
    }

    public function getPaymentPending(int $userId)
    {
        $activeContract = Contract::isActive($userId)
            ->with([
                'payments:id,contract_id,price_contracted,balance,type_invoice,type_payment',
                'plan:id,description,number_of_clients,gigabytes_storage,price'
            ])
            ->select(['id', 'plan_id', 'price', 'hiring_date'])
            ->first();;

        if (!$activeContract) {
            throw new HttpException(404, 'Contrato não encontrado');
        }

        return $activeContract;
    }
}
