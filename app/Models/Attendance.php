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

    public function getWorkingTimeAttribute(){
        $end = new Carbon($this->end_time);
        $start = new Carbon($this->start_time);
        $work = $end->diffInSeconds($start);
        $rest = strtotime($this->sumrestingtime);
        // dd($rest);
        // dd(date('y-m-d H:i:s', $rest));

        $times = $work - $rest + 2 * strtotime('1970-01-01');
        // $seconds = $times % 60;
        // $minutes = ($times - $seconds) / 60 % 60;
        // dd(gettype($minutes));
        // $hours = ($times - $seconds - $minutes * 60) / 3600;
        // $time = sprintf('%02d', $hours).':'.sprintf('%02d',$minutes).':'.sprintf('%02d', $seconds);
        // $time->subHours(9);
        // dd(gettype($time));
        // $time =(string)$time;
        // $time->format('H:i:s');
        // $time->toTimeString();
        // dd($time);
        // dd($end);
        // dd($start);
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
        // return date('H:i:s', array_sum($sumrest));
        // $seconds = $times % 60;
        // $minutes = ($times - $seconds) / 60 % 60;
        // $hours = ($times - $seconds - $minutes * 60) / 3600;
        // $time = sprintf('%02d', $hours).':'.sprintf('%02d',$minutes).':'.sprintf('%02d', $seconds);
        $time = date('H:i:s', $times);
        return $time;
    }
}