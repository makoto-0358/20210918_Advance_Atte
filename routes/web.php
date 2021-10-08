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

Route::get('/session', [SessionController::class, 'getSes']);
Route::post('/session', [SessionController::class, 'postSes']);

Route::get('/', function () {
    return view('index');
})->middleware(['auth'])->name('index');

Route::get('/attendance', function () {
    $attendance = Attendance::all();
    // $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->first();
    // dd($attendance);
    // $rest = Rest::all();
    // $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->first();
    // $attendance['rest_data'] = Rest::where('attendance_id', $attendance['id'])->get();
    // dd($rest);
    // dd($attendance['rest_data']);
    // $attendance['rest_time'] = $attendance['rest_data']->('end_time'-'start_time')->get();
    // dd($attendance['rest_time']);
    // $attendance['rest_times'] = sum($attendance['rest_data']->('end_time'-'start_time')->get();
    // $start_time = strtotime($attendance['start_time']);
    // $end_time = strtotime($attendance['end_time']);
    // // $attendance['work_time'] = $end_time-$start_time;
    // $attendance = Attendance::where('start_time','2021-09-30 17:39:32')->first();
    // // dd($attendance);
    // $work_start_time = strtotime($attendance['start_time']);
    // $work_end_time = strtotime($attendance['end_time']);
    // // dd($work_end_time);
    // $work_time = $work_end_time-$work_start_time;
    // // dd($work_time);
    // $attendance['work_time'] = $work_time;
    // dd($$attendance['work_time']);
    return view('attendance',['items' => $attendance]);
})->middleware(['auth'])->name('attendance');

Route::post('/attendance/start', [AttendanceController::class, 'start']);
Route::post('/attendance/end', [AttendanceController::class, 'end']);
Route::post('/rest/start', [RestController::class, 'start']);
Route::post('/rest/end', [RestController::class, 'end']);

require __DIR__.'/auth.php';