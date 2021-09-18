<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserContoroller;
use App\Http\Controllers\TimeContoroller;
use App\Http\Controllers\SessionContoroller;

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

Route::get('/home',[TimeController::class,'index'])->middleware('auth');
Route::post('/start',[TimeController::class,'start']);
Route::post('/close',[TimeController::class,'close']);
Route::post('/breakstart',[TimeController::class,'breakstart']);
Route::post('/breakend',[TimeController::class,'breakend']);
Route::get('/attendance',[TimeController::class,'attendance'])->middleware('auth');

Route::get('/register',[AtteUserController::class,'register']);
Route::post('/register',[AtteUserController::class,'regist']);
Route::get('/login',[AtteUserController::class,'login']);
Route::post('/loggin',[AtteUserController::class,'loggin']);
Route::post('/logout',[AtteUserController::class,'logout']);

Route::get('/session', [SessionController::class, 'getSes']);
Route::post('/session', [SessionController::class, 'postSes']);

Route::get('/auth', [AuthorController::class,'check']);
Route::post('/auth', [AuthorController::class,'checkUser']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
