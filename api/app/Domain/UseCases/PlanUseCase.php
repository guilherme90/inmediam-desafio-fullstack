<?php

namespace App\Domain\UseCases;

use App\Domain\Models\Plan;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PlanUseCase
{
    public function getById(int $id): Plan
    {
        $plan = Plan::where('id', '=', $id)
            ->where('active', '=', true)
            ->first();

        if (!$plan) {
            throw new HttpException(404, 'Plano não encontrado');
        }

        return $plan;
    }

    public function getAll()
    {
        return Plan::where('active', true)->get();
    }
}
