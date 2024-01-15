<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HirePlanTest extends TestCase
{
    use RefreshDatabase;

    const PATH = '/api/plans/contracts';

    /**
     * @test
     */
    public function planNotFound(): void
    {
        $response = $this->post(static::PATH, [
            'user_id' => 1,
            'plan_id' => 8,
            'price' => 0,
            'type_invoice' => 'debit',
            'type_payment' => 'pix'
        ]);

        $response
            ->assertNotFound()
            ->assertJson([
                'message' => 'Plano não encontrado'
            ]);
    }

    /**
     * @test
     */
    public function hirePlanSuccessfully(): void
    {
        $response = $this->post(static::PATH, [
            'user_id' => 1,
            'plan_id' => 2,
            'price' => 87,
            'type_invoice' => 'debit',
            'type_payment' => 'pix'
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'message' => 'Plano contratado com sucesso'
            ]);
    }

    public function userNotFound(): void
    {
        $response = $this->post(static::PATH, [
            'user_id' => 3,
            'plan_id' => 2,
            'price' => 87,
            'type_invoice' => 'debit',
            'type_payment' => 'pix'
        ]);

        $response
            ->assertNotFound()
            ->assertJson([
                'message' => 'Usuário não encontrado'
            ]);
    }
}
