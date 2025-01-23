<?php

use App\Http\Controllers\Administrator\AdministratorDashboard;
use App\Http\Controllers\Administrator\AdministratorPengguna;
use App\Http\Controllers\Administrator\AdministratorReport;

use App\Http\Controllers\User\UserPengguna;
use App\Http\Controllers\User\UserDashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\User\UserReport;

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
    return view('auth.login');
});

// memprosess login
Route::post('processLogin', [LoginController::class, 'processLogin'])->name('processLogin');

// Menampilkan halaman pendaftaran
Route::get('signup', [SignupController::class, 'index'])->name('signup');

// Memproses pendaftaran
Route::post('processRegister', [SignupController::class, 'processRegister'])->name('processRegister');

// route logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth.administrator'], function () {
    // dashboard administrator
    Route::get('/administrator/dashboard/list', [AdministratorDashboard::class, 'index'])->name('administrator.dashboard');

    // administrator reporttodo tanpa show
    Route::resource('/administrator/reporttodo', AdministratorReport::class)
        ->except(['show'])
        ->parameters(['reporttodo' => 'uuid'])
        ->names([
            'index' => 'administrator.reporttodo.list',
            'create' => 'administrator.reporttodo.create',
            'store' => 'administrator.reporttodo.store',
            'edit' => 'administrator.reporttodo.edit',
            'update' => 'administrator.reporttodo.update',
            'destroy' => 'administrator.reporttodo.destroy',
        ]);
    // administrator reporttodo rute untuk konfirmasi penghapusan reporttodo
    Route::get('/administrator/reporttodo/{uuid}/konfirmasi', [AdministratorReport::class, 'konfirmasi'])->name('administrator.reporttodo.konfirmasi');

    // administrator reporttodo route search
    Route::get('/administrator/reporttodo/search', [AdministratorReport::class, 'search'])->name('administrator.reporttodo.search');


    // administrator pengguna tanpa show
    Route::resource('/administrator/pengguna', AdministratorPengguna::class)
        ->except(['show'])
        ->parameters(['pengguna' => 'uuid'])
        ->names([
            'index' => 'administrator.pengguna.list',
            'create' => 'administrator.pengguna.create',
            'store' => 'administrator.pengguna.store',
            'edit' => 'administrator.pengguna.edit',
            'update' => 'administrator.pengguna.update',
            'destroy' => 'administrator.pengguna.destroy',
        ]);
    // administrator pengguna rute untuk konfirmasi penghapusan pengguna
    Route::get('/administrator/pengguna/{uuid}/konfirmasi', [AdministratorPengguna::class, 'konfirmasi'])->name('administrator.pengguna.konfirmasi');

    // administrator pengguna route search
    Route::get('/administrator/pengguna/search', [AdministratorPengguna::class, 'search'])->name('administrator.pengguna.search');

    // administrator route untuk menampilkan account setting pengguna
    Route::get('/administrator/pengguna/account-setting', [AdministratorPengguna::class, 'profil'])->name('administrator.pengguna.account-setting');

    // administrator route untuk memperbarui profil pengguna
    Route::put('/administrator/pengguna/updatePRofil/{uuid}', [AdministratorPengguna::class, 'updateProfil'])->name('administrator.pengguna.updateProfil');
});


Route::group(['middleware' => 'auth.user'], function () {
    // dashboard user
    Route::get('/user/dashboard/list', [UserDashboard::class, 'index'])->name('user.dashboard');

    // user reporttodo tanpa show
    Route::resource('/user/reporttodo', UserReport::class)
        ->except(['show'])
        ->parameters(['reporttodo' => 'uuid'])
        ->names([
            'index' => 'user.reporttodo.list',
            'create' => 'user.reporttodo.create',
            'store' => 'user.reporttodo.store',
            'edit' => 'user.reporttodo.edit',
            'update' => 'user.reporttodo.update',
            'destroy' => 'user.reporttodo.destroy',
        ]);


    // user pengguna route konfirmasi
    Route::get('/user/reporttodo/{uuid}/konfirmasi', [UserReport::class, 'konfirmasi'])->name('user.reporttodo.konfirmasi');

    // user pengguna route search
    Route::get('/user/reporttodo/search', [UserReport::class, 'search'])->name('user.reporttodo.search');

    // user route untuk menampilkan account setting pengguna
    Route::get('/user/pengguna/account-setting', [UserPengguna::class, 'index'])->name('user.pengguna.account-setting');

    // user route untuk memperbarui profil pengguna
    Route::put('/user/pengguna/updatePRofil/{uuid}', [UserPengguna::class, 'updateProfil'])->name('user.pengguna.updateProfil');
});
