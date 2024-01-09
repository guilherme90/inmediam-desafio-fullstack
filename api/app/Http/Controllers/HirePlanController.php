<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\ContractUseCase;
use App\Domain\UseCases\PaymentUseCase;
use App\Http\Controllers\Requests\HirePlanRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HirePlanController extends Controller
{
    public function __construct(
        private readonly ContractUseCase $contractUseCase,
        private readonly PaymentUseCase $paymentUseCase
    )
    {}

    public function store(HirePlanRequest $request): JsonResponse
    {
        $input = $request->validated();

        try {
            $this->paymentUseCase->pay();
            $this->contractUseCase->createContract();

            return \response()->json(['message' => 'Plano contratado com sucesso']);
        } catch (\HttpException $e) {
            return \response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        } catch (\Exception $e) {
            return \response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
