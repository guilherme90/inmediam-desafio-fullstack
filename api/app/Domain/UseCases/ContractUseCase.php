<?php

namespace App\Domain\UseCases;

use App\Domain\Models\Contract;
use App\Domain\Models\Plan;

class ContractUseCase
{
    public function createContract(int $userId, Plan $plan): int
    {
        $hasActiveContract = Contract::isActive($userId)->first();

        if ($hasActiveContract) {
            $hasActiveContract->active = false;
            $hasActiveContract->updated_at = now();
            $hasActiveContract->deleted_at = now();
            $hasActiveContract->save();
        }

        $contract = Contract::create([
            'user_id' => $userId,
            'plan_id' => $plan['id'],
            'price' => $plan['price']
        ]);

        return $contract['id'];
    }

    public function getActiveContract(int $userId): Contract
    {
        return Contract::where('user_id', '=', $userId)->where('active', '=', true)->first();
    }
}
