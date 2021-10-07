<?php

use App\Http\Controllers\EnquetesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OneEqueteController;
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';
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

Route::get('/',[HomeController::class, 'show'])->name('home');
Route::post('/voto-enquetes',[HomeController::class, 'update'])->name('vote');

Route::get('/enquete/{enquete}',[OneEqueteController::class, 'show'])->name('enquete');

Route::get('/dashboard',[EnquetesController::class, 'show'])->middleware(['auth'])->name('dashboard');
Route::post('/dashboard/nova-enquete',[EnquetesController::class, 'create'])->middleware(['auth'])->name('newEnquete');
Route::post('dashboard/excluir-enquete',[EnquetesController::class, 'delete'])->middleware(['auth'])->name('deleteEnquete');
Route::post('/dashboard/atualiza-enquete',[EnquetesController::class, 'update'])->middleware(['auth'])->name('updateEnquete');



