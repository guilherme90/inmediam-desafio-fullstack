<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\ContractPlanUseCase;
use App\Http\Controllers\Requests\HirePlanRequest;
use App\Http\Controllers\Requests\MakePaymentRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ContractPlanController extends Controller
{
    public function __construct(
        private readonly ContractPlanUseCase $contractPlanUseCase
    )
    {}

    public function store(HirePlanRequest $request): JsonResponse
    {
        try {
            $input = $request->validated();

            $this->contractPlanUseCase->process(
                $input['user_id'],
                $input['plan_id'],
                $input['price'],
                $input['type_invoice'],
                $input['type_payment']
            );

            return \response()->json(['message' => 'Plano contratado com sucesso']);
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

    public function update(MakePaymentRequest $request): JsonResponse
    {
        try {
            $input = $request->validated();

            $this->contractPlanUseCase->pay($input['user_id'], $input['contract_id']);

            return \response()->json([]);
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

    public function show(int $userId): JsonResponse
    {
        try {
            $payment = $this->contractPlanUseCase->getActiveContract($userId);

            return \response()->json($payment);
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
