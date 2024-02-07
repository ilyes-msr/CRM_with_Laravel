<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('customers/{id}', [CustomerController::class, 'show']);
Route::post('customers', [CustomerController::class, 'create']);
Route::patch('customers/{id}', [CustomerController::class, 'update']);
Route::delete('customers/{id}', [CustomerController::class, 'delete']);
Route::get('customers', [CustomerController::class, 'index']);

Route::get('customers/{customer_id}/notes/{id}', [NoteController::class, 'show']);
Route::post('customers/{customer_id}/notes', [NoteController::class, 'create']);
Route::patch('customers/{customer_id}/notes/{id}', [NoteController::class, 'update']);
Route::delete('customers/{customer_id}/notes/{id}', [NoteController::class, 'delete']);
Route::get('customers/{customer_id}/notes', [NoteController::class, 'index']);
