<?php

use Illuminate\Support\Facades\Route;
use JeroenNoten\LaravelAdminLte\Http\Controllers\DarkModeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your package. These
| routes are loaded by your package ServiceProvider within a group which
| contains the "web" middleware group.
|
*/

//-----------------------------------------------------------------------------
// Dark Mode routes.
//-----------------------------------------------------------------------------

// Route::post('/darkmode/toggle', [DarkModeController::class, 'toggle'])
//     ->name('darkmode.toggle');

// Route::get('dashboard', [AdminController::class, 'dashboard']); 
// Route::get('login', [AdminController::class, 'index'])->name('login');
// Route::post('admin-login', [AdminController::class, 'adminLogin'])->name('login.admin'); 
// // Route::get('registration', [AdminController::class, 'registration'])->name('register-user');
// // Route::post('custom-registration', [AdminController::class, 'customRegistration'])->name('register.custom'); 
// Route::get('signout', [AdminController::class, 'signOut'])->name('signout');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::get('/pengaduan',[HomeController::class, 'show'])->name('pengaduan');
Route::get('/pengaduan/{pengaduan:id}',[HomeController::class, 'detail']);
Route::post('/pengaduan/balas/{pengaduan:id}',[HomeController::class, 'balas']);
Route::put('/pengaduan/proses/{pengaduan:id}',[HomeController::class, 'update_proses']);
Route::put('/pengaduan/selesaikan/{pengaduan:id}',[HomeController::class, 'update_close']);
Route::get('/',[AdminController::class, 'dashboardAdmin']);
Route::get('/home',[HomeController::class, 'dashboardAdmin']);
Route::get('/login',[AdminController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[AdminController::class, 'login']);
Route::post('/logout',[AdminController::class, 'logout']);
