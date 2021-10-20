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
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        if(isset($attendance)){
            // 休憩中でないことを確認。
            $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->whereNull('end_time')->first();
            if(!isset($rest)){
                $form = $request->all();
                $form['attendance_id'] = $attendance->id;
                Rest::create($form);
                $request->session()->flash('message', '休憩開始しました');
            }else{
                $request->session()->flash('message', '休憩中なので休憩開始できません');
            }
        }else{
            $request->session()->flash('message', '勤務開始していないため休憩開始できません');
        }
        return redirect('');
    }
    public function end(Request $request){

        // 出勤中であることを確認。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        if(isset($attendance)){
            // 休憩中であることを確認。
            $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->whereNull('end_time')->first();
            if(isset($rest)){
                $form = $request->all();
                $form['end_time'] = now();
                unset($form["_token"]);
                $rest->update($form);
                $request->session()->flash('message', '休憩終了しました');
            }else{
                $request->session()->flash('message', '休憩中ではないので休憩終了できません');
            }
        }else{
            $request->session()->flash('message', '勤務開始していないため休憩終了できません');
        }
        return redirect('');
    }
}