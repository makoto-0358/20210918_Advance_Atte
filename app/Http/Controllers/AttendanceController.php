<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Rest;
use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // ホーム画面
    public function index(){

        // 休憩レコードを空として定義しておく。
        $rest = '';

        // 出勤中レコードを検索。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();

        // 出勤中の場合、休憩中レコードを上書きする。
        if(isset($attendance)){
            $rest = Rest::where('attendance_id', $attendance['id'])->latest('id')->whereNull('end_time')->first();
        }

        return view('index', compact('attendance', 'rest'));
    }

    // 日付別勤怠ページ
    public function attendance(Request $request){

        // 年月日情報が渡されていない場合、現在年月日で表示する。
        $date = now();
        $date = date('Y-m-d', strtotime($date));

        // 年月日情報が渡された場合は、渡された年月日で表示する。
        if(isset($request->date)){
            $date = $request->date;
            list($Y, $m, $d) = explode('-', $date);
            if(checkdate($m, $d, $Y) != true){
                return redirect()->route('attendance');
            }
        }

        // 該当年月日における出勤レコードを5件ずつ表示する。
        $attendance = Attendance::where('start_time', 'like', "$date%")->paginate(5);

        return view('attendance', [
            'items' => $attendance,
            'date' => date('Ymd', strtotime($date)),
            'beforedate' => date('Y-m-d', strtotime("$date -1 day")),
            'afterdate' => date('Y-m-d', strtotime("$date +1 day")),
        ]);
    }

    // 勤務開始
    public function start(Request $request){

        // 休憩レコードを空として定義しておく。
        $rest = '';
        
        // 出勤中レコードを検索。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();

        // フラッシュメッセージ。グレーアウト＆postなのでブラウザ上では操作できない場合も念の為設定しておく。
        $message = '';
        if(!isset($attendance)){
            $form = $request->all();
            $form['user_id'] = Auth::user()->id;
            $form['start_time'] = now();
            Attendance::create($form);
            $message = '勤務開始しました';
        }else{
            $message = '勤務中なので勤務開始できません';
        }

        if(!empty($message)){
            $request->session()->flash('message', $message);
        }
        
        return redirect()->route('index');
    }

    // 勤務終了
    public function end(Request $request){

        // 出勤中レコードを検索。
        $attendance = Attendance::where('user_id', Auth::user()->id)->latest('id')->whereNull('end_time')->first();

        // フラッシュメッセージ。グレーアウト＆postなのでブラウザ上では操作できない場合も念の為設定しておく。
        $message = '';
        if(isset($attendance)){
            // 休憩中レコードを検索。
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

        return redirect()->route('index');
    }
}