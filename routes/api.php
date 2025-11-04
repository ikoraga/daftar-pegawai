<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    EmployeesController,
    LookupController,
    UnitController,
    PrintController
};

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('employees', [EmployeesController::class, 'index']);
    Route::post('employees', [EmployeesController::class, 'store']);
    Route::get('employees/{employees}', [EmployeesController::class, 'show']);
    Route::put('employees/{employees}', [EmployeesController::class, 'update']);
    Route::delete('employees/{employees}', [EmployeesController::class, 'destroy']);

    Route::get('lookups', [LookupController::class, 'index']);

    Route::get('units', [UnitController::class, 'index']);
    Route::post('units', [UnitController::class, 'store']);
    Route::put('units/{unit}', [UnitController::class, 'update']);
    Route::delete('units/{unit}', [UnitController::class, 'destroy']);

    Route::get('print/employees', [PrintController::class, 'employees']);

    Route::post('logout', [AuthController::class, 'logout']);
});
