<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function(){
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);

    Route::group(['middleware'=>'admin'], function(){
        Route::resource('/dashboard', AdminController::class);
    });

    //logout
    Route::get('logout', [AdminController::class, 'logout']);

    //update password
    Route::match(['get', 'post'],'update-password', [AdminController::class, 'updatePassword']);

    //update password
    Route::post('check-current-password', [AdminController::class, 'checkCurrentPassword']);
});

