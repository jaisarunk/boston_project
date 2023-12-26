<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[BookController::class, 'list']);
Route::get('form',[BookController::class, 'form']);
Route::get('product/{id}/view',[BookController::class, 'view']);
Route::delete('delete/{id}',[BookController::class, 'delete']);
