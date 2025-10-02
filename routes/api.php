<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\RefGroupWhatsappController;
use App\Http\Controllers\RefFeeController;
use App\Http\Controllers\RefRadiusController;
use App\Http\Controllers\FileController;


use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']); 
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::prefix('parents')->group(function () {
    Route::get('/', [ParentController::class, 'index']);
    Route::post('/', [ParentController::class, 'store']);
    Route::get('/{id}', [ParentController::class, 'show']);
    Route::put('/{id}', [ParentController::class, 'update']);
    Route::delete('/{id}', [ParentController::class, 'destroy']);
});


Route::get('/members', [MemberController::class, 'index']);
Route::post('/members', [MemberController::class, 'store']);
Route::get('/members/{id}', [MemberController::class, 'show']);
Route::put('/members/{id}', [MemberController::class, 'update']);
Route::delete('/members/{id}', [MemberController::class, 'destroy']);

Route::prefix('group-whatsapp')->group(function () {
    Route::get('/', [RefGroupWhatsappController::class, 'index']);
    Route::post('/', [RefGroupWhatsappController::class, 'store']);
    Route::get('/{id}', [RefGroupWhatsappController::class, 'show']);
    Route::put('/{id}', [RefGroupWhatsappController::class, 'update']);
    Route::delete('/{id}', [RefGroupWhatsappController::class, 'destroy']);
});

Route::get('/ref-fee', [RefFeeController::class, 'index']);
Route::get('/ref-fee/{id}', [RefFeeController::class, 'show']);
Route::post('/ref-fee', [RefFeeController::class, 'store']);
Route::put('/ref-fee/{id}', [RefFeeController::class, 'update']);
Route::delete('/ref-fee/{id}', [RefFeeController::class, 'destroy']);

Route::prefix('ref-radius')->group(function () {
    Route::get('/', [RefRadiusController::class, 'index']);
    Route::get('/{id}', [RefRadiusController::class, 'show']);
    Route::post('/', [RefRadiusController::class, 'store']);
    Route::put('/{id}', [RefRadiusController::class, 'update']);
    Route::delete('/{id}', [RefRadiusController::class, 'destroy']);
});

Route::prefix('files')->group(function () {
    Route::get('/', [FileController::class, 'index']);
    Route::post('/', [FileController::class, 'store']);
    Route::get('/{id}', [FileController::class, 'show']);
    Route::put('/{id}', [FileController::class, 'update']);
    Route::delete('/{id}', [FileController::class, 'destroy']);
    });
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
});
