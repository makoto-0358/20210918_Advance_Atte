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


        // 休憩中でないことを確認。


        // $this->validate($request, Rest::$rules);
        $form = $request->all();
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->first();
        $form['attendance_id'] = $attendance->id;
        Rest::create($form);
        return redirect('');
    }
    public function end(Request $request){

        // 休憩中であることを確認。


        // $this->validate($request, Rest::rules);
        $form = $request->all();
        $form['end_time'] = now();
        unset($form["_token"]);
        $rest = Rest::where('attendance_id', Auth::user()->id)->latest('id')->first()->update($form);
        return redirect('');
    }
}