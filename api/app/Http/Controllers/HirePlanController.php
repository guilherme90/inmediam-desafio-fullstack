<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\ContractUseCase;
use App\Domain\UseCases\HirePlanUseCase;
use App\Domain\UseCases\PaymentUseCase;
use App\Domain\UseCases\PlanUseCase;
use App\Http\Controllers\Requests\HirePlanRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HirePlanController extends Controller
{
    public function __construct(
        private readonly HirePlanUseCase $hirePlanUseCase
    )
    {}

    public function store(HirePlanRequest $request): JsonResponse
    {
        try {
            $input = $request->validated();

            $this->hirePlanUseCase->process(
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
}
