<?php

namespace Tests\Unit;

use App\Domain\Models\Contract;
use App\Domain\Models\Payment;
use App\Domain\Models\Plan;
use App\Domain\UseCases\ContractUseCase;
use App\Domain\UseCases\ContractPlanUseCase;
use App\Domain\UseCases\PaymentUseCase;
use App\Domain\UseCases\PlanUseCase;
use App\Domain\UseCases\UserUseCase;
use App\Traits\CalculateBalanceTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentUseCaseTest extends TestCase
{
    use RefreshDatabase;
    use CalculateBalanceTrait;

    private int $userId = 1;

    private ContractUseCase $contractUseCase;
    private PlanUseCase $planUseCase;
    private ContractPlanUseCase $hirePlanUseCase;

    private function gwtHirePlanUseCase(): ContractPlanUseCase
    {
        $userUseCase = new UserUseCase();
        return new ContractPlanUseCase(
            new ContractUseCase($userUseCase),
            new PaymentUseCase(),
            new PlanUseCase(),
            $userUseCase
        );
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    private function createPayment(int $planId, float $pricePaid): void
    {
        $this->gwtHirePlanUseCase()->process(
            $this->userId,
            $planId,
            $pricePaid,
            'debit',
            'pix'
        );
    }

    /**
     * @test
     */
    public function shouldSelectingPlanWithHigherValue()
    {
        $this->createPayment(2, 87);
        $this->createPayment(3, 197);

        $contract = Contract::select(['id', 'price', 'plan_id'])
            ->where('active', '=', true)
            ->first();

        $this->assertSame('197.00', $contract['price']);
        $this->assertSame(3, $contract['plan_id']);

        $payment = Payment::where('contract_id', '=', $contract['id'])->first();

        $balance = $this->getOutstandingBalance(197.00);
        $this->assertSame('197.00', $payment['price_contracted']);
        $this->assertSame("-{$balance}", $payment['balance']);
        $this->assertSame('debit', $payment['type_invoice']);
        $this->assertNull($payment['type_payment']);
        $this->assertSame('pending', $payment['status']);
    }

    /**
     * @test
     */
    public function shouldSelectingPlanWithALowerValue()
    {
        $this->createPayment(3, 197);
        $this->createPayment(1, 9.9);

        $contract = Contract::where('active', '=', true)->first();

        $this->assertSame('9.90', $contract['price']);
        $this->assertSame(1, $contract['plan_id']);

        $payment = Payment::where('contract_id', '=', $contract['id'])->first();

        $balance = $this->getOutstandingBalance(9.9);
        $this->assertSame('9.90', $payment['price_contracted']);
        $this->assertSame("{$balance}", $payment['balance']);
        $this->assertSame('credit', $payment['type_invoice']);
        $this->assertSame('pix', $payment['type_payment']);
        $this->assertSame('pending', $payment['status']);
    }
}
