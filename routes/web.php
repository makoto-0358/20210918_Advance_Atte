<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserContoroller;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SessionController;

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

Route::get('/session', [SessionController::class, 'getSes']);
Route::post('/session', [SessionController::class, 'postSes']);

Route::get('/', function () {
    return view('index');
})->middleware(['auth'])->name('index');

Route::get('/attendance', function () {
    return view('attendance');
})->middleware(['auth'])->name('attendance');

Route::post('/startatte', [AttendanceController::class, 'startatte']);
Route::post('/endatte', [AttendanceController::class, 'endatte']);
Route::post('/startbreak', [BreakController::class, 'startbreak']);
Route::post('/endbreak', [BreakController::class, 'endbreak']);

require __DIR__.'/auth.php';