<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Http\controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;


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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function() {Route::resource('/books', App\Http\Controllers\BookController::class);
});

Route::get('/profile', [UserController::class,'index']);

Route::put('/profile/{username}',[UserController::class,'profileUpdate']);

Route::post('/recommend', [BookController::class, 'updateStatus']);
