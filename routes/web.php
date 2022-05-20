<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\OrdersController;

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
Route::get('/banned',[SettingController::class,'banned'])->name('banned');
Route::get('/fatoorah/callback',[OrdersController::class,'callback']);
Route::get('/Login/{provider}',[AuthController::class,'SocialiteLogin']);
Route::get('/Login/{provider}/callback',[AuthController::class,'SocialiteCallBack']);
    Route::middleware(['settings','checkauth','banned'])->group(function(){
        Route::get('/{any}', function () {
            return view('Master_pages.User');
        })->where('any','.*');
    });

