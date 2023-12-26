<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

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

Route::get('show',[BookController::class, 'show']);
Route::get('/',[BookController::class, 'show']);
Route::get('form',[BookController::class, 'form']);
Route::post('create',[BookController::class, 'create']);
Route::get('product/{id}/edit',[BookController::class, 'edit']);
Route::put('update',[BookController::class, 'update']);
