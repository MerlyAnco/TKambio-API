<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list-reports', [ReportController::class, 'index']);
Route::post('/generate-report', [ReportController::class, 'create']);
Route::get('/get-report/{id}', [ReportController::class, 'download']);