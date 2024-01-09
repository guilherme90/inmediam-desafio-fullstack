<?php

namespace Database\Seeders;

use App\Domain\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'description' => 'Individual',
                'numberOfClients' => 1,
                'price' => 9.90,
                'gigabytesStorage' => 1,
            ], [
                'description' => 'Até 10 vistorias / clientes ativos',
                'numberOfClients' => 10,
                'price' => 87.00,
                'gigabytesStorage' => 10,
            ], [
                'description' => 'Até 25 vistorias / clientes ativos',
                'numberOfClients' => 25,
                'price' => 197.00,
                'gigabytesStorage' => 25,
            ], [
                'description' => 'Até 50 vistorias / clientes ativos',
                'numberOfClients' => 50,
                'price' => 347.00,
                'gigabytesStorage' => 50,
            ], [
                'description' => 'Até 100 vistorias / clientes ativos',
                'numberOfClients' => 100,
                'price' => 497.00,
                'gigabytesStorage' => 100,
            ], [
                'description' => 'Até 250 vistorias / clientes ativos',
                'numberOfClients' => 250,
                'price' => 797.00,
                'gigabytesStorage' => 25,
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
