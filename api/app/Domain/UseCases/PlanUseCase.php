<?php

namespace App\Domain\UseCases;

use App\Domain\Models\Plan;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PlanUseCase
{
    public function __construct(private readonly Plan $plan)
    {
    }

    public function getById(int $id): Plan
    {
        $plan = $this->plan->newQuery()
            ->select(['id', 'price'])
            ->where('id', '=', $id)
            ->where('active', '=', true)
            ->first();

        if (!$plan) {
            throw new HttpException(404, 'Plano não encontrado');
        }

        return $plan;
    }
}
