<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
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
Route::get('/hello', function () {
  return view('welcome');
});

Route::name('users.')->prefix('users')->group(function() {
    Route::get('/',[UserController::class, 'index'])->name('index');
    Route::post('/store',[UserController::class, 'store'])->name('store');
    Route::get('/notify',[UserController::class, 'notify'])->name('notify');
    Route::get('/show-notify',[UserController::class, 'showNotify'])->name('showNotify');
    Route::get('/queue-job',[UserController::class, 'queueJob'])->name('queueJob');
});

Route::name('posts.')->prefix('posts')->group(function() {
    Route::get('/',[\App\Http\Controllers\PostController::class, 'index'])->name('index');
});
