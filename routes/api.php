<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    EmployeesController,
    LookupController,
    UnitController,
    PrintController,
    EmployeePhotoController
};

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('employees', [EmployeesController::class, 'index']);
    Route::post('employees', [EmployeesController::class, 'store']);
    Route::get('employees/{id}', [EmployeesController::class, 'show']);
    Route::put('employees/{id}', [EmployeesController::class, 'update']);
    Route::delete('employees/{id}', [EmployeesController::class, 'destroy']);
    Route::post('employees/{id}/photo', [EmployeesController::class, 'uploadPhoto']);
    Route::get('lookups', [LookupController::class, 'index']);
    Route::get('units', [UnitController::class, 'index']);
    Route::post('units', [UnitController::class, 'store']);
    Route::put('units/{unit}', [UnitController::class, 'update']);
    Route::delete('units/{unit}', [UnitController::class, 'destroy']);
    Route::get('print/employees', [PrintController::class, 'employees']);
    Route::post('employee-photos', [EmployeePhotoController::class, 'store']);
    Route::delete('employee-photos/{photo}', [EmployeePhotoController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);
});
