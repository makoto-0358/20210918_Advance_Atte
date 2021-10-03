<?php

namespace App\Http\Controllers;

use App\Models\Rest;
use Illuminate\Support\facades\Auth;
use App\Models\Attendance;
use Illuminate\Http\Request;

class restController extends Controller
{
    public function start(Request $request){

        // 出勤中であることを確認。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->first();
        $start_time = strtotime($attendance['start_time']);
        $end_time = strtotime($attendance['end_time']);
        $notattendance = $end_time-$start_time;

        // 休憩中でないことを確認。
        $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->first();
        if(isset($rest)){
            $rest_start_time = strtotime($rest['start_time']);
            $rest_end_time = strtotime($rest['end_time']);
            $notrest = $rest_end_time-$rest_start_time;
        };

        if($notattendance !== 0){
            return redirect('');
        }elseif(isset($rest) && $notrest == 0){
            return redirect('');
        }else{
            // $this->validate($request, Rest::$rules);
            $form = $request->all();
            $form['attendance_id'] = $attendance->id;
            Rest::create($form);
            return redirect('');
        }
    }
    public function end(Request $request){

        // 出勤中であることを確認。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->first();
        $start_time = strtotime($attendance['start_time']);
        $end_time = strtotime($attendance['end_time']);
        $notattendance = $end_time-$start_time;

        // 休憩中であることを確認。
        $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->first();
        if(isset($rest)){
            $rest_start_time = strtotime($rest['start_time']);
            $rest_end_time = strtotime($rest['end_time']);
            $notrest = $rest_end_time-$rest_start_time;
        };

        if($notattendance !== 0){
            return redirect('');
        }elseif($rest == null){
            return redirect('');
        }elseif(isset($rest) && $notrest !== 0){
            return redirect('');
        }else{
            // $this->validate($request, Rest::rules);
            $form = $request->all();
            $form['end_time'] = now();
            unset($form["_token"]);
            $rest->update($form);
            return redirect('');
        }
    }
}