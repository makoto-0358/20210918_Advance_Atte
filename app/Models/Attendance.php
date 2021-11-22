<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    public static $rules = array(
        'user_id' => 'required',
    );

    // 合計勤務時間。勤務終了時刻と勤務開始時刻の差から合計休憩時間を引いた値。
    public function getWorkingTimeAttribute(){
        $end = new Carbon($this->end_time);
        $start = new Carbon($this->start_time);
        $work = $end->diffInSeconds($start);
        $rest = strtotime($this->sumrestingtime);
        $times = $work - $rest + 2 * strtotime('1970-01-01');
        $time = date('H:i:s', $times);
        return $time;
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function rests(){
        return $this->hasMany('App\Models\Rest');
    }

    public function getNameAttribute(){
        $user = User::where('id', $this->user_id)->first();
        return $user->name;
    }

    // 合計休憩時間。
    public function getSumRestingTimeAttribute(){
        $rests = Rest::where('attendance_id', $this->id)->get();
        $sumrest =array();
        foreach($rests as $rest){
            $end = new Carbon($rest['end_time']);
            $start = new Carbon($rest['start_time']);
            $rest['time'] = $end->diffInSeconds($start);
            array_push($sumrest, $rest['time']);
        }
        $times = array_sum($sumrest) + strtotime('1970-01-01');
        $time = date('H:i:s', $times);
        return $time;
    }
}