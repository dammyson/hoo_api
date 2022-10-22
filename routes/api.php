<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventKindsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Auth'], function () {
    Route::post('login',  [AuthController::class,'postLogin'])->name('auth.login');
    Route::post('registration', [AuthController::class,'create'])->name('auth.registration');
    Route::get('kinds',  [EventKindsController::class,'get'])->name('kind.get');
    Route::post('send_sms', [AuthController::class,'SendSms'])->name('auth.send');
    Route::post('verify_sms', [AuthController::class,'VerifySms'])->name('auth.verify');
});



Route::prefix('profile')->middleware('auth:api')->group(function () {
    Route::post('/', [ProfileController::class,'update'])->name('user.update_profile');
    Route::get('/', [ProfileController::class,'get'])->name('user.get_profile');
    Route::post('/password', [ProfileController::class,'updatePassword'])->name('password.update');
});


Route::prefix('events')->middleware('auth:api')->group(function () {
    Route::get('/', [EventController::class,'list'])->name('list');
    Route::post('/', [EventController::class,'create'])->name('event.create');
    Route::get('/{id}', [EventController::class,'get'])->name('list');
});

Route::prefix('tickets')->middleware('auth:api')->group(function () {
   // Route::get('/', [EventController::class,'list'])->name('list');
    Route::post('/', [TicketController::class,'create'])->name('event.create');
    Route::get('/{event_id}', [TicketController::class,'get'])->name('list');
    Route::post('/buy', [TicketController::class,'buy'])->name('event.buy');
});