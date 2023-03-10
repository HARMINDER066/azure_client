<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\auth\AuthController;
use App\Http\Controllers\staff\auth\AuthController as StaffAuthController;

use App\Http\Controllers\user\auth\UserAuthController;

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


//Route::get('/', [AuthController::class, 'showLoginForm'])->name('admin.login');

Route::group(['prefix' => 'admin'], function(){
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('admin.login');
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('admin.login.submit'); 
});


Route::group(['prefix' => 'staff'], function(){
    Route::get('/', [StaffAuthController::class, 'showLoginForm'])->name('staff.login');
        Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('staff.login');
    Route::post('/login', [StaffAuthController::class, 'authenticate'])->name('staff.login.submit'); 
});


Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [UserAuthController::class, 'authenticate'])->name('user.login.submit'); 


Route::get('cache-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    dd("Success..! OK");
});

