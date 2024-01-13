<?php

namespace App\Http\Controllers;

use App\Domain\Models\Plan;
use App\Domain\UseCases\PlanUseCase;

class PlanController extends Controller
{
    public function __construct(private readonly PlanUseCase $planUseCase)
    {
    }

    /**
     * Display a listing of the plans.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->planUseCase->getAll();
    }

    public function show(int $id)
    {
        return $this->planUseCase->getById($id);
    }
}
