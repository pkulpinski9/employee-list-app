<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\EmployeeController::class, 'index'])->name('welcome');
Route::get('/export/{emp_no}', [App\Http\Controllers\EmployeeController::class, 'export'])->name('home');

Auth::routes();


