<?php

namespace App\Domain\UseCases;

use App\Domain\Enums\PaymentStatusEnum;
use App\Domain\Enums\TypePaymentEnum;
use App\Domain\Models\Contract;
use App\Domain\Models\Payment;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ContractPlanUseCase
{
    public function __construct(
        private readonly ContractUseCase $contractUseCase,
        private readonly PaymentUseCase $paymentUseCase,
        private readonly PlanUseCase $planUseCase,
        private readonly UserUseCase $userUseCase
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
        $this->userUseCase->getUser($userId);
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
        $this->userUseCase->getUser($userId);
        $activeContract = Contract::isActive($userId)->first();

        if (!$activeContract) {
            throw new HttpException(404, 'Contrato não encontrado');
        }

        $paymentPending = Payment::query()
            ->where('contract_id', $contractId)
            ->where('status',PaymentStatusEnum::PENDING)
            ->first();

        if (!$paymentPending) {
            throw new HttpException(404, 'Contrato não encontrado');
        }

        $paymentPending->price_paid = abs($paymentPending['balance']);
        $paymentPending->balance = 0;
        $paymentPending->type_payment = TypePaymentEnum::PIX;
        $paymentPending->status = PaymentStatusEnum::PAID;
        $paymentPending->updated_at = now();
        $paymentPending->save();
    }

    public function getActiveContract(int $userId)
    {
        $this->userUseCase->getUser($userId);
        $activeContract = Contract::isActive($userId)
            ->with([
                'payments' => function ($query) {
                    $query
                        ->select('id' ,'contract_id', 'price_contracted' , 'balance', 'type_invoice', 'type_payment', 'status')
                        ->where('status', PaymentStatusEnum::PENDING);
                },
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
