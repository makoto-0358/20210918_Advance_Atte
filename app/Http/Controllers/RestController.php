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

        if(empty($attendance)){
        }elseif(!empty($attendance['end_time'])){
        }else{
            // 休憩中でないことを確認。
            $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->first();
            if(!empty($rest) && empty($rest['end_time'])){
            }else{
                $form = $request->all();
                $form['attendance_id'] = $attendance->id;
                Rest::create($form);
            }
        }
        return redirect('');
    }
    public function end(Request $request){

        // 出勤中であることを確認。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->first();

        if(empty($attendance)){
        }elseif(!empty($attendance['end_time'])){
        }else{
            // 休憩中であることを確認。
            $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->first();
            if(empty($rest)){
            }elseif(!empty($rest['end_time'])){
            }else{
                $form = $request->all();
                $form['end_time'] = now();
                unset($form["_token"]);
                $rest->update($form);
            }
        }
        return redirect('');
    }
}