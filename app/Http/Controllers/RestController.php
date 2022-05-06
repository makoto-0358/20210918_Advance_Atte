<?php

namespace App\Http\Controllers;

use App\Models\Rest;
use Illuminate\Support\facades\Auth;
use App\Models\Attendance;
use Illuminate\Http\Request;

class restController extends Controller
{
    // 休憩開始
    public function start(Request $request){

        // 出勤中レコードを検索。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();

        // 勤務中レコードがある場合、休憩中レコードを検索。
            // 休憩中でなければ、現在時刻で休憩開始する。
        if(isset($attendance)){
            $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->whereNull('end_time')->first();
            if(!isset($rest)){
                $form = $request->all();
                $form['attendance_id'] = $attendance->id;
                $form['start_time'] = now();
                Rest::create($form);
            }
        }

        return redirect()->route('index');
    }
    
    // 休憩終了
    public function end(Request $request){

        // 出勤中レコードを検索。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();

        // 出勤中レコードがある場合、休憩中レコードを検索。
            // 休憩中であれば、現在時刻で休憩終了する。。
        if(isset($attendance)){
            $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->whereNull('end_time')->first();
            if(isset($rest)){
                $form = $request->all();
                $form['end_time'] = now();
                unset($form["_token"]);
                $rest->update($form);
            }
        }

        return redirect()->route('index');
    }
}