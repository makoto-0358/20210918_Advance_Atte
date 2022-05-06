<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserContoroller;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\SessionController;
use App\Models\Attendance;
use App\Models\Rest;

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

// Route::get('/session', [SessionController::class, 'getSes'])
// ->middleware(['verified']);
// Route::post('/session', [SessionController::class, 'postSes']);

Route::get('/', [AttendanceController::class, 'index'])
->middleware(['verified'])->name('index');

Route::get('/attendance/{date?}', [AttendanceController::class, 'attendance'])
->middleware(['verified'])->name('attendance');

Route::post('/attendance/start', [AttendanceController::class, 'start'])
->middleware(['auth']);
Route::post('/attendance/end', [AttendanceController::class, 'end'])
->middleware(['auth']);
Route::post('/rest/start', [RestController::class, 'start'])
->middleware(['auth']);
Route::post('/rest/end', [RestController::class, 'end'])
->middleware(['auth']);

Route::get('/userattendance', [AttendanceController::class, 'userattendance'])
->middleware(['verified'])->name('userattendance');

require __DIR__.'/auth.php';