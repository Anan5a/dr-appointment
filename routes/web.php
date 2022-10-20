<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\AppoinmentController;
use App\Http\Controllers\AppointmentDataController;
use App\Http\Controllers\DoctorQualificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('page.main');

Route::group(['middleware'=>["auth","verified", "permission"]], function (){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home.index');
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::resource('user', UserController::class);

    Route::group(['prefix'=>'admin', 'as'=>'admin.'], function (){
        Route::get('/', [AdminController::class, 'index'])->name('home.index');
        Route::resource('doctor-profile', DoctorQualificationController::class);
        Route::resource('role', RoleController::class);
        Route::resource('permission', PermissionController::class);
    });
    Route::resource('schedule', ScheduleController::class);
    Route::resource('appointment', AppoinmentController::class);
    Route::resource('appointment-log', AppointmentDataController::class);

});

/**
 * Should not be changed
 */
Auth::routes(['verify'=>true]);
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect(\route('page.main'));
})->middleware(['auth', 'signed'])->name('verification.verify');
