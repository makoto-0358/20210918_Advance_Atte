<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){

        $rest = '';
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();

        if(isset($attendance)){
            $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->whereNull('end_time')->first();
        }

        return view('index', [
            $attendance,
            $rest
        ]);
    }

    public function attendance(Request $request){

        $date = now();

        if(isset($request->date)){
            $date = $request->date;
            list($Y, $m, $d) = explode('-', $date);
            if(checkdate($m, $d, $Y) != true){
                return redirect()->route('attendance');
            }
        }

        $date = date('Y-m-d', strtotime($date));

        $attendance = Attendance::where('start_time', 'like', "$date%")->paginate(5);

        return view('attendance', [
            'items' => $attendance,
            'date' => date('Ymd', strtotime($date)),
            'beforedate' => date('Y-m-d', strtotime("$date -1 day")),
            'afterdate' => date('Y-m-d', strtotime("$date +1 day")),
        ]);
    }

    public function start(Request $request){

        $rest = '';
        // 出勤中でないことを確認。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        $message = '';
        if(!isset($attendance)){
            $form = $request->all();
            $form['user_id'] = Auth::user()->id;
            Attendance::create($form);
            $message = '勤務開始しました';
        }else{
            $message = '勤務中なので勤務開始できません';
        }

        if(!empty($message)){
            $request->session()->flash('message', $message);
        }
        
        return redirect()->route('index', [
            $attendance,
            $rest
        ]);
    }
    public function end(Request $request){

        // 出勤中であることを確認。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        $message = '';
        if(isset($attendance)){
            // 休憩中でないことを確認。
            $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->whereNull('end_time')->first();
            if(!isset($rest)){
                $form = $request->all();
                $form['end_time'] = now();
                unset($form["_token"]);
                $attendance->update($form);
                $message = '勤務終了しました';
            }else{
                $message = '休憩中なので勤務終了できません';
            }
        }else{
            $message = '勤務開始していないため勤務終了できません';
        }

        if(!empty($message)){
            $request->session()->flash('message', $message);
        }

        return redirect()->route('index', [
            $attendance,
            $rest
        ]);
    }
}