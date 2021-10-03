<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function start(Request $request){

        // 出勤中でないことを確認。
        $atte = Attendance::where('user_id', Auth::user()->id)->latest('id')->first();
        $start_time = strtotime($atte['start_time']);
        $end_time = strtotime($atte['end_time']);
        // dd($atte);
        // dd(start_time);
        // dd($end_time);
        $notatte = $end_time-$start_time;
        // var_dump($notatte);
        // dd($notatte);
        // $s = date('Y/m/d H:i:s', $start_time);
        // dd($s);
        // $w = date('Y/m/d H:i:s', $end_time);
        // dd($w);
        // $input = [
        //     'start_time' => '$start_time',
        //     'end_time' => '$end_time'
        // ];
        // dd($input);
        // $filtered = $atte->only(['start_time', 'end_time']);
        // $filtered->toArray();
        // dd($filtered);
        // $validate_rule = [
        //     // 'notatte' => 'different:0',
        //     'end_time' => 'date|after:start_time',
        // ];
        // dd($validate_rule);

        if($notatte == 0){
            return redirect('');
        }else{
            // $this->validate($request, Attendance::$rules);
        $form = $request->all();
        $form['user_id'] = Auth::user()->id;
        Attendance::create($form);
        return redirect('');
        }
    }
    public function end(Request $request){

        // 出勤中であることを確認。
        $atte = Attendance::where('user_id', Auth::user()->id)->latest('id')->first();
        $start_time = strtotime($atte['start_time']);
        $end_time = strtotime($atte['end_time']);
        $notatte = $end_time-$start_time;

        // 休憩中でないことを確認。


        // $this->validate($request, Attendance::rules);
        $form = $request->all();
        $form['end_time'] = now();
        unset($form["_token"]);
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->first()->update($form);
        return redirect('');
    }
}
