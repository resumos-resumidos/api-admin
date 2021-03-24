<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthJWTController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\HomeController;

Route::post('auth/login', [AuthJWTController::class, 'login']);
Route::post('auth/register', [AuthJWTController::class, 'register']);

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('auth/logout', [AuthJWTController::class, 'logout']);
    Route::post('auth/refresh', [AuthJWTController::class, 'refresh']);
    Route::get('auth/me', [AuthJWTController::class, 'me']);

    Route::get('home', [HomeController::class, 'index']);

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
});
