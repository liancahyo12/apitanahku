<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PengaduanKomenController;
use App\Http\Controllers\VerifyEmailController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group w hich
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

    ], 
    function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
    

    //     // Verify email
    // Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    // ->middleware(['signed', 'throttle:6,1'])
    // ->name('verification.verify');

    // // Resend link to verify email
    // Route::post('/email/verify/resend', function (Request $request) {
    // $request->user()->sendEmailVerificationNotification();
    // return back()->with('message', 'Verification link sent!');
    // })->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

    
    }

);
    Route::group([
        'middleware' => 'api'
    
        ], 
        function ($router) {
            Route::post('/register', [AuthController::class, 'register']);
            Route::get('/pengaduans', [PengaduanController::class, 'index']);
            Route::get('/pengaduans/{id}', [PengaduanController::class, 'show']);
            Route::post('/pengaduans', [PengaduanController::class, 'store']);
            Route::put('/pengaduansproses/{id}', [PengaduanController::class, 'update_proses']);
            Route::put('/pengaduansclose/{id}', [PengaduanController::class, 'update_close']);
            Route::delete('/pengaduans/{id}', [PengaduanController::class, 'destroy']);
            Route::post('/pengaduankomens/{id}', [PengaduanKomenController::class, 'store']);
            Route::get('/pengaduankomens', [PengaduanKomenController::class, 'index']);
            Route::get('/pengaduankomens/{id}', [PengaduanController::class, 'showkomen']);
        }
);