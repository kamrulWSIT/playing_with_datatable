<?php

use App\Http\Controllers\EmployeeController;
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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');

Route::get('/scroll-employees', [EmployeeController::class, 'scrollIndex'])->name('scroll.employees');

Route::get('/get-employees', [EmployeeController::class, 'getEmployee'])->name('get.employees');
