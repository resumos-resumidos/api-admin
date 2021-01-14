<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\SummaryController;

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

Route::get('disciplines', [DisciplineController::class, 'index']);
Route::get('disciplines/{discipline}', [DisciplineController::class, 'show']);
Route::post('disciplines', [DisciplineController::class, 'store']);
Route::put('disciplines/{discipline}', [DisciplineController::class, 'update']);
Route::delete('disciplines/{discipline}', [DisciplineController::class, 'destroy']);

Route::get('contents', [ContentController::class, 'index']);
Route::get('contents/{content}', [ContentController::class, 'show']);
Route::post('contents', [ContentController::class, 'store']);
Route::put('contents/{content}', [ContentController::class, 'update']);
Route::delete('contents/{content}', [ContentController::class, 'destroy']);

Route::get('summaries', [SummaryController::class, 'index']);
Route::get('summaries/{summary}', [SummaryController::class, 'show']);
Route::post('summaries', [SummaryController::class, 'store']);
Route::put('summaries/{summary}', [SummaryController::class, 'update']);
Route::delete('summaries/{summary}', [SummaryController::class, 'destroy']);
