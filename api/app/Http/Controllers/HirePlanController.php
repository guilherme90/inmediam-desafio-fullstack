<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\ContractUseCase;
use App\Domain\UseCases\PaymentUseCase;
use App\Domain\UseCases\PlanUseCase;
use App\Http\Controllers\Requests\HirePlanRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HirePlanController extends Controller
{
    public function __construct(
        private readonly ContractUseCase $contractUseCase,
        private readonly PaymentUseCase $paymentUseCase,
        private readonly PlanUseCase $planUseCase
    )
    {}

    public function store(HirePlanRequest $request): JsonResponse
    {
        try {
            $input = $request->validated();
            $plan = $this->planUseCase->getById($input['plan_id']);

            $contractId = $this->contractUseCase->createContract($input['user_id'], $plan);
            // $this->paymentUseCase->pay($input);

            return \response()->json(['message' => 'Plano contratado com sucesso', 'id' => $contractId]);
        } catch (HttpException $e) {
            return \response()->json([
                'message' => $e->getMessage()
            ], $e->getStatusCode());
        } catch (\Exception $e) {
            return \response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
