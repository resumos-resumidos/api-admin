<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisciplineController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/disciplines', [DisciplineController::class, 'index']);
Route::get('/disciplines/{discipline}', [DisciplineController::class, 'show']);
Route::post('/disciplines', [DisciplineController::class, 'store']);
Route::put('disciplines/{discipline}', [DisciplineController::class, 'update']);
Route::delete('disciplines/{discipline}', [DisciplineController::class, 'destroy']);
