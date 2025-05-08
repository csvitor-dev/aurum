<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\Api\Account\CreateAccountController;
use App\Http\Controllers\Api\Account\GetAccountByIdController;
use Illuminate\Support\Facades\Route;

Route::prefix('/account')->group(function () {
    Route::post('/', CreateAccountController::class);

    Route::get('/{uuid}', GetAccountByIdController::class);
});
