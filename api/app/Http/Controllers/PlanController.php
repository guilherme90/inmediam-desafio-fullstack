<?php

namespace App\Http\Controllers;

use App\Domain\Models\Plan;

class PlanController extends Controller
{
    /**
     * Display a listing of the plans.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Plan::all();
    }
}
