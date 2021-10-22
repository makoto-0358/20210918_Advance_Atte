<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){
        return view('index');
    }

    public function attendance(Request $request){
        // $attendance = Attendance::paginate(5);
        // dd($date);
        // $date = substr(now(), 0, 10);
        $date = now();
        // dd($date);
        if(isset($request->date)){
            $date = $request->date;
            // dd($date);
            list($Y, $m, $d) = explode('-', $date);
            if(checkdate($m, $d, $Y) != true){
                return view('attendance');
            }
        }
        // dd($date);
        // $date = strtotime($date);
        // $date = substr(date('Y-m-d', $date), 0, 10);
        // dd($date);
        $date = date('Y-m-d', strtotime($date));
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
        // dd($attendance);
        // $attendance = Attendance::paginate(5);
        $data = [
            'items' => $attendance,
            'date' => date('Ymd', strtotime($date)),
            'beforedate' => date('Y-m-d', strtotime("$request->date -1 day")),
            'afterdate' => date('Y-m-d', strtotime("$request->date +1 day")),
        ];
        // dd($data);

        // //前日と、翌日の日付を取得
        // $nextDate = new Date($date, strtotime('+1 day'));
        // $prevDate = new Date($date, strtotime('-1 day'));

        // return view('attendance', [$nestDate, $prevDate, $attendance->paginate(5)]);
        return view('attendance', $data);
    }

    public function start(Request $request){

        // 出勤中でないことを確認。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();
        if(!isset($attendance)){
            $form = $request->all();
            $form['user_id'] = Auth::user()->id;
            Attendance::create($form);
            $request->session()->flash('message', '勤務開始しました');
        }else{
            $request->session()->flash('message', '勤務中なので勤務開始できません');
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
                $request->session()->flash('message', '勤務終了しました');
            }else{
                $request->session()->flash('message', '休憩中なので勤務終了できません');
            }
        }else{
            $request->session()->flash('message', '勤務開始していないため勤務終了できません');
        }
        return redirect('');
    }
}