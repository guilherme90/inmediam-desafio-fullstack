<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\ContractPlanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return response()->json(['message' => 'ok']);
});

Route::prefix('plans')->group(function () {
    Route::get('/', [PlanController::class, 'index']);

    Route::prefix('contracts')->group(function () {
        Route::post('/', [ContractPlanController::class, 'store']);
        Route::put('/', [ContractPlanController::class, 'update']);
        Route::get('/{userId}/pending', [ContractPlanController::class, 'show'])->whereNumber('userId');
    });
});

Route::prefix('users')->group(function () {
    Route::get('/{id}', [UserController::class, 'show']);
});
