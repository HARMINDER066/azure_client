<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\auth\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\PlanController;
use App\Http\Controllers\admin\StaffController;




Route::group(['middleware' => 'admin'], function(){
	Auth::routes(['register' => false]);

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/user/register', [UserController::class, 'userregisterform'])->name('admin.user.register');
Route::post('/user/submit', [UserController::class, 'userregistersubmit'])->name('admin.user.submit');
Route::get('user', [UserController::class, 'index'])->name('admin.user.index');
Route::post('user_list', [UserController::class, 'user_list'])->name('admin.user.user_list');
Route::get('user_status/{id}/{state}',[UserController::class, 'active_inactive'])->name('user.status');
Route::get('user_edit/{id}', [UserController::class, 'user_edit'])->name('user.user_edit');
Route::post('user_edit_submit/{id}', [UserController::class, 'user_edit_submit'])->name('user.user_edit_submit');
Route::post('fb_account_delete/', [UserController::class, 'fb_account_delete'])->name('user.fb_account_delete');
Route::get('updateSubscription/{id}', [UserController::class, 'updateSubscription'])->name('user.updateSubscription');
Route::post('updateSubscriptionStore/{id}', [UserController::class, 'updateSubscriptionStore'])->name('user.updateSubscriptionStore');
Route::get('updateSubscription/{id}', [UserController::class, 'updateSubscription'])->name('user.updateSubscription');
Route::post('subscription/',[UserController::class, 'subscription'])->name('user.subscription');
Route::get('sendlicence/{id}',[UserController::class, 'sendlicence'])->name('user.sendlicence');
Route::get('changeemail',[AdminController::class, 'ChangeEmail'])->name('admin.changeemail');
Route::post('changeemailstore',[AdminController::class, 'ChangeEmailStore'])->name('admin.changeemailstore');
Route::get('changepassword',[AdminController::class, 'ChangePassword'])->name('admin.changepassword');
Route::post('changepassword',[AdminController::class, 'ChangePassword'])->name('admin.changepassword');
Route::post('userdelete/',[UserController::class, 'deleteUser'])->name('admin.user.userdelete');
Route::get('logout',[AdminController::class, 'Logout'])->name('admin.logout');
Route::get('plan',[PlanController::class, 'index'])->name('admin.plan.index');
Route::post('plan_list', [PlanController::class, 'plan_list'])->name('admin.plan.plan_list');
Route::get('plan_add',[PlanController::class, 'plan_add'])->name('admin.plan.plan_add');
Route::post('plan_add_submit', [PlanController::class, 'plan_add_submit'])->name('admin.plan.plan_add_submit');
Route::get('plan_edit/{id}',[PlanController::class, 'plan_edit'])->name('admin.plan.plan_edit');
Route::post('plan_edit_submit/{id}', [PlanController::class, 'plan_edit_submit'])->name('admin.plan.plan_edit_submit');
Route::post('plandelete/',[PlanController::class, 'plandelete'])->name('admin.plan.plandelete');
Route::get('plan_status/{id}/{state}',[PlanController::class, 'plan_status'])->name('admin.plan.plan_status');

Route::get('staff',[StaffController::class, 'index'])->name('admin.staff.index');
Route::post('stafflist', [StaffController::class, 'staff_list'])->name('admin.staff.staff_list');
Route::get('staff_add',[StaffController::class, 'staff_add'])->name('admin.staff.staff_add');
Route::post('staff_add_submit', [StaffController::class, 'staff_add_submit'])->name('admin.staff.staff_add_submit');
Route::get('staff/{id}',[StaffController::class, 'staff_edit'])->name('admin.staff.staff_edit');
Route::post('staff_edit_submit/{id}', [StaffController::class, 'staff_edit_submit'])->name('admin.staff.staff_edit_submit');
Route::post('staffdelete/',[StaffController::class, 'staffdelete'])->name('admin.staff.staffdelete');
Route::get('staff_status/{id}/{state}',[StaffController::class, 'staff_status'])->name('admin.staff.staff_status');

});