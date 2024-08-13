<?php

use App\Http\Controllers\Autentikasi\AuthController;
use App\Http\Controllers\Karyawan\Home\HomeController as HomeHomeController;
use App\Http\Controllers\Karyawan\Order\OrderController as OrderOrderController;
use App\Http\Controllers\Karyawan\Profile\ProfileController as ProfileProfileController;
use App\Http\Controllers\Owner\Account\UserAccountController;
use App\Http\Controllers\Owner\Home\HomeController;
use App\Http\Controllers\Owner\Order\OrderController;
use App\Http\Controllers\Owner\Profile\ProfileController;
use App\Http\Controllers\Owner\Tracking\TrackingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Dashboard
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/postlogin', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/createregister', [AuthController::class, 'createRegister']);

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('owner')
        ->middleware('role:owner')
        ->group(function () {
            //Home
            Route::get('/home', [HomeController::class, 'index']);
            Route::post('/home/create', [HomeController::class, 'store']);
            Route::get('/home/edit/{id}', [HomeController::class, 'edit']);
            Route::post('/home/update/{id}', [HomeController::class, 'update']);
            Route::delete('/home/destroy/{id}', [HomeController::class, 'destroy']);

            //Jenis Tracking
            Route::get('/tracking', [TrackingController::class, 'index']);
            Route::post('/tracking/create', [TrackingController::class, 'store']);
            Route::get('/tracking/edit/{id}', [TrackingController::class, 'edit']);
            Route::post('/tracking/update/{id}', [TrackingController::class, 'update']);
            Route::delete('/tracking/destroy/{id}', [TrackingController::class, 'destroy']);

            //Order
            Route::get('/order', [OrderController::class, 'index']);
            Route::post('/order/create', [OrderController::class, 'store']);
            Route::get('/order/edit/{id}', [OrderController::class, 'edit']);
            Route::post('/order/update/{id}', [OrderController::class, 'update']);
            Route::delete('/order/destroy/{id}', [OrderController::class, 'destroy']);
            Route::post('/order/updatestatusorder/{id}', [OrderController::class, 'updateStatusOrder']);

            //Account User
            Route::get('/account', [UserAccountController::class, 'index']);
            Route::post('/account/create', [UserAccountController::class, 'store']);
            Route::get('/account/edit/{id}', [UserAccountController::class, 'edit']);
            Route::post('/account/update/{id}', [UserAccountController::class, 'update']);
            Route::delete('/account/destroy/{id}', [UserAccountController::class, 'destroy']);
            Route::post('/account/changepassword/{id}', [UserAccountController::class, 'ubahpassword'])->name('change');

            //Profile
            Route::get('/profile', [ProfileController::class, 'index']);
            Route::post('/profile/create', [ProfileController::class, 'store']);
            Route::get('/profile/edit/{id}', [ProfileController::class, 'edit']);
            Route::post('/profile/update/{id}', [ProfileController::class, 'update']);
            Route::delete('/profile/destroy/{id}', [ProfileController::class, 'destroy']);
            //Change Password
            Route::get('/changepassword', [UserAccountController::class, 'indexupdatepassword']);
            Route::post('/changepassword', [UserAccountController::class, 'updatepassword'])->name('changepassword');
        });
});

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('karyawan')
        ->middleware('role:karyawan')
        ->group(function () {
            //Home
            Route::get('/home', [HomeHomeController::class, 'index']);

            //Order
            Route::get('/order', [OrderOrderController::class, 'index']);
            Route::post('/order/create', [OrderOrderController::class, 'store']);
            Route::get('/order/edit/{id}', [OrderOrderController::class, 'edit']);
            Route::post('/order/update/{id}', [OrderOrderController::class, 'update']);
            Route::delete('/order/destroy/{id}', [OrderOrderController::class, 'destroy']);
            Route::post('/order/updatestatusorder/{id}', [OrderOrderController::class, 'updateStatusOrder']);

            //Profile
            Route::get('/profile', [ProfileProfileController::class, 'index']);
            Route::post('/profile/create', [ProfileProfileController::class, 'store']);
            Route::get('/profile/edit/{id}', [ProfileProfileController::class, 'edit']);
            Route::post('/profile/update/{id}', [ProfileProfileController::class, 'update']);
            Route::delete('/profile/destroy/{id}', [ProfileProfileController::class, 'destroy']);

            //Change Password
            Route::get('/changepassword', [UserAccountController::class, 'indexupdatepasswordkaryawan']);
            Route::post('/changepassword', [UserAccountController::class, 'updatepasswordkaryawan'])->name('changepassword-karyawan');
        });
});
