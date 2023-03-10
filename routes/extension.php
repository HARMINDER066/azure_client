<?php
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ExtensionController;
use Illuminate\Support\Facades\Route;

Route::get('command', function () {
	
	/* php artisan migrate */
            Artisan::call('passport:install');
    dd("Done");
});
// Route::post('ext_login', [ApiAuthController::class, 'subscriber_login_v2'])->name('ext_login');
Route::group(['middleware' => 'auth:api'], function () {
  
});
