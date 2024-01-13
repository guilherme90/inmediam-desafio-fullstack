<?php

namespace App\Domain\UseCases;

use App\Domain\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserUseCase
{
    public function getUser(int $userId): User
    {
        $user = User::select('id')->where('id', $userId)->first();

        if (!$user) {
            throw new HttpException(404, 'Usuário não encontrado');
        }

        return $user;
    }
}
