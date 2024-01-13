<?php

namespace App\Domain\UseCases;

use App\Domain\Models\Contract;
use App\Domain\Models\Plan;

class ContractUseCase
{
    public function __construct(private readonly UserUseCase $userUseCase)
    {
    }

    public function createContract(int $userId, Plan $plan): Contract
    {
        $this->userUseCase->getUser($userId);
        $hasActiveContract = Contract::isActive($userId)->first();

        if ($hasActiveContract) {
            $hasActiveContract->active = false;
            $hasActiveContract->updated_at = now();
            $hasActiveContract->deleted_at = now();
            $hasActiveContract->save();
        }

        return Contract::create([
            'user_id' => $userId,
            'plan_id' => $plan['id'],
            'price' => $plan['price']
        ]);
    }
}
