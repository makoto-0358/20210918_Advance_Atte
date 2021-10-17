<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function attendance(Request $request){
        // $attendance = Attendance::paginate(5);
        $date = substr(now(), 0, 10);
        // dd($date);
        // $requestにdateパラメータが存在するか
        // $date = new Date(); //本日の日付を指定
        // if(isset($request->date)){
        //     //有効日付チェックをする

        //     //上書く
        // //     $date = new Date($request->date);
        // }

        //$dateを先に
        $attendance = Attendance::where('start_time', 'like', "$date%")->paginate(5);
        // $attendance = Attendance::paginate(5);

        // //前日と、翌日の日付を取得
        // $nextDate = new Date($date, strtotime('+1 day'));
        // $prevDate = new Date($date, strtotime('-1 day'));

        // return view('attendance', [$nestDate, $prevDate, $attendance->paginate(5)]);
        return view('attendance',['items' => $attendance]);
    }

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