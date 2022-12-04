<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Home\HomeController;
use \App\Http\Controllers\Admin\Home\CsvController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::resource('home',HomeController::class);

Route::get('csv', [CsvController::class, 'create'])->name('csv.store');
Route::post('csv', [CsvController::class, 'store'])->name('csv.create');
