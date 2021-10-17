<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function start(Request $request){

        // 出勤中でないことを確認。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        if(!isset($attendance)){
            $form = $request->all();
            $form['user_id'] = Auth::user()->id;
            Attendance::create($form);
        }
        return redirect('');
    }
    public function end(Request $request){

        // 出勤中であることを確認。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        if(isset($attendance)){
            // 休憩中でないことを確認。
            $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->whereNull('end_time')->first();
            if(!isset($rest)){
                $form = $request->all();
                $form['end_time'] = now();
                unset($form["_token"]);
                $attendance->update($form);
            }
        }
        return redirect('');
    }
}