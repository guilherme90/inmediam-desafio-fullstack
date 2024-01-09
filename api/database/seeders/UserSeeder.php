<?php

namespace Database\Seeders;

use App\Domain\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Usuário da Silva',
            'email' => 'usuario@silva.com',
        ]);
    }
}
