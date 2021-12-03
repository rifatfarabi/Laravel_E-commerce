<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\MainController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [MainController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('/admin/login',[LoginController::class, 'showAdminLogin'])->name('admin.login');
