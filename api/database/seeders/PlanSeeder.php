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
                'number_of_clients' => 1,
                'price' => 9.90,
                'gigabytes_storage' => 1,
            ], [
                'description' => 'Até 10 vistorias / clientes ativos',
                'number_of_clients' => 10,
                'price' => 87.00,
                'gigabytes_storage' => 10,
            ], [
                'description' => 'Até 25 vistorias / clientes ativos',
                'number_of_clients' => 25,
                'price' => 197.00,
                'gigabytes_storage' => 25,
            ], [
                'description' => 'Até 50 vistorias / clientes ativos',
                'number_of_clients' => 50,
                'price' => 347.00,
                'gigabytes_storage' => 50,
            ], [
                'description' => 'Até 100 vistorias / clientes ativos',
                'number_of_clients' => 100,
                'price' => 497.00,
                'gigabytes_storage' => 100,
            ], [
                'description' => 'Até 250 vistorias / clientes ativos',
                'number_of_clients' => 250,
                'price' => 797.00,
                'gigabytes_storage' => 25,
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
