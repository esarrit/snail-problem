<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SnailController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// REST Endpoint for getting all of the attempts made by the snail
Route::get('/snailAttempts', [SnailController::class, 'index'])->name('snailAttemtps');

// REST Endpoint for solving the snail problem with the given parameters and store the values in the database
Route::put('/snailCheck', [SnailController::class, 'snailCheck'])->name('snailCheck');
