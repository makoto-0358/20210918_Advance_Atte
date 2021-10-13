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

    // public function getStart(){
    //     return $this->strtotime('start_time');
    // }

    // public function getEnd(){
    //     return $this->strtotime('end_time');
    // }



    // public function getWorkingTimeAttribute(){
    //     $end = $this->strtotime('end_time');
    //     $start = $this->strtotime('start_time');
    //     return $this->$end - $start;
    // }

    // public function getWorkingTimeAttribute(){
    //     return $this->strtotime('end_time')-$this->strtotime('start_time');
    // }

    // public function getWorkingTimeAttribute(){
    //     return $this->end_time;
    // }

    public function getWorkingTimeAttribute(){
        $time = strtotime($this->end_time) - strtotime($this->start_time) + strtotime('1970-01-01');
        return date('H:i:s', $time);
    }

    // public function getWorkingTimeAttribute(){
    //     return strtotime('$this->end_time') - strtotime('$this->start_time');
    // }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function rests(){
        return $this->hasMany('App\Models\Rest');
    }

    // public function getTimeAttribute(){
    //     $sumrest = Rest::where('attendance_id', $this->id)->get();
    //     $rest['time'] = strtotime('end_time') - strtotime('start_time') + strtotime('1970-01-01');
    //     return $rest['time'];
    // }

    public function getSumRestingTimeAttribute(){
        // $sumrest = Rest::where('attendance_id', $this->id)->sum('resting_time');
        // $rest = Rest::all();
        // **$rests = Rest::where('attendance_id', $this->id)->latest('start_time')->first();
        // $end = Carbon::parse($rest['end_time']);
        // dd($rests);
        // $start = Carbon::parse($rest['start_time']);
        // dd(gettype($rest));
        // **if($rests  != null){
            // **$end = new Carbon($rests['end_time']);
            // **$start = new Carbon($rests['start_time']);
            // dd($end);
            // **$rests['time'] = $end->diffInSeconds($start);
        // $rest['time'] = $rest['end_time']->diffInSeconds($rest['start_time']);
        // $rest['time'] = strtotime('end_time') - strtotime('start_time');NG
            // dd($rest['time']);
            // dd(gettype($rest['time']));
        // **}else
            // **$rests['time'] = 0;
            // dd(gettype($rest['time']));
        // **$rests['time'] = (string)$rests['time'];
        // $sumrest = array();
        // dd(gettype($sumrest));
        // dd(gettype($rest['time']));
        // dd($rest['time']);
        // $sumrest = $rest['time'];
        // dd($sumrest);
        // dd($rests);
        // dd($rest['start_time']);
        // dd(gettype($rest['time']));
        // foreach($rests as $rest){
            // isset($time);
            // dd($rest);
            // dd($time);
            // dd($a);
            // print_r($time);
            // dd(gettype($rest));
            // dd(gettype($time));
            // dd(gettype($value));
            // echo $rests->time;
            // dd($rest->time);
            // dd(gettype($rests->time));
            // array_push($sumrest, $rest->time);
            // **$sumrest = $rests->time;
            // dd($sumrest);
        // }
        // dd($sumstart);
        // for($id = 1; $id<=86400; $id++){
        //     array_push($sumstart, $id);
        // }
        // $sumrest = array_sum($sumstart);
        // dd($rest['time']);
        // dd($rest);
        // $sumrest = sum($rest['time']);
        // $sumrest = Rest::where('attendance_id', $this->id)->sum('time');
        // dd($sumrest);
        // $rest = Rest::where('attendance_id', $this->id)->sum('start_time' - 'end_time');
        // $sumstart = Rest::where('attendance_id', $this->id)->sum('start_time');
        // $sumend = Rest::where('attendance_id', $this->id)->sum('end_time');
        // $sumrest = $sumend - $sumstart + strtotime('1970-01-01');
        // dd($sumrest);
        // $rest = Rest::all();
        // $rest['time'] = strtotime($rest['end_time']) - strtotime($rest['start_time']) + strtotime('1970-01-01');
        // $sumrest = Rest::where('attendance_id', $this->id)->sum($rest['time']);
        // $sumrest = sum($rest['resting_time']);
        // // $time = strtotime($this->end_time) - strtotime($this->start_time) + strtotime('1970-01-01');

        // $sumstart = Rest::where('attendance_id', $this->id)->sum('start_time');
        // $sumend = Rest::where('attendance_id', $this->id)->sum('end_time');
        // $sumrest = $sumend - $sumstart;

        // $start = strtotime('start_time');
        // $start = strtotime('start_time');
        // $time = Rest::where('attendance_id', $this->id)->get();
        // $time['start'] = strtotime('start_time');
        // $time['end'] = strtotime('end_time');
        // // dd($time);
        // $time['sumstart'] = sum($time['start']);
        // $time['sumend'] = sum($time['end']);
        // $time['sumrest'] = $time['sumend'] - $time['sumstart'] + strtotime('1970-01-01');


        // $time = Rest::where('attendance_id', $this->id)->get();
        // // dd($time);
        // // if($time == 'empty'){
        // //     dd($time);
        // //     $sumresttime = strtotime('1970-01-01');
        // // }else{
        //     // dd($time);
        //     // $start = array(strtotime($this->start_time));
        //     $start = array_column($time, 'start_time');
        //     // dd($start);
        //     $end = array(strtotime($this->end_time));
        //     // $end = array_column($time, 'end_time');
        //     // $time['sumstart'] = array_sum($time['start']);
        //     // $time['sumend'] = array_sum($time['end']);
        //     // $time['sumrest'] = $time['end'] - $time['start'];
            
        //     $sumresttime = array_sum($end) - array_sum($start);
        // // }

        // $time = Rest::where('attendance_id', $this->id)->get();
        // $start = array_column($time, strtotime('start_time'));
        // $end = array_column($time, strtotime('end_time'));
        // $sumstart = array_sum($start, 'start_time');
        // $sumend = array_sum($end, 'end_time');
        // $sumrest = $sumend - $sumstart + strtotime('1970-01-01');

        
        // $time = Rest::where('attendance_id', $this->id)->get();
        // $start = sum(strtotime($time->start_time));

        // $sumend = Rest::where('attendance_id', $this->id)->get();

        // $sumrest = $sumend - $sumstart + strtotime('1970-01-01');

        // $rest = Rest::where('attendance_id', $this->id)->get();
        // // $rest = Rest::all();
        // if( $rest !=='empty'){
        //     $rest['difH'] = $rest['start_time']->diffInHours($rest['end_time']);
        //     $rest['difM'] = $rest['start_time']->diffInMinutes($rest['end_time']);
        //     $rest['difS'] = $rest['start_time']->diffInSeconds($rest['end_time']);
        //     $sumrest = $rest['difS'];
        // }
        // dd($rest);
        
        
            // return date($sumrest);


            $rests = Rest::where('attendance_id', $this->id)->get();
            // dd($rests);
            // if(isset($rests)){
                // dd($rests);
                $sumrest =array();
                foreach($rests as $rest){
                    $end = new Carbon($rest['end_time']);
                    $start = new Carbon($rest['start_time']);
                    $rest['time'] = $end->diffInSeconds($start);
                    // dd($rest);
                    // dd($rest['time']);
                    // dd(gettype($rest['time']));
                    // $rest['time'] = (string)$rest['time'];
                    // dd(gettype($rest['time']));
                    array_push($sumrest, $rest['time']);
                }

            //     dd($rests['end_time']);
            //     $end = new Carbon($rests['end_time']);
            //     $start = new Carbon($rests['start_time']);
            //     $rests['time'] = $end->diffInSeconds($start);
            //     $sumrest = $rests->time;
            //     dd($sumrest);
            // }else{
            //     $sumrest = 0;
            // }
            $resttime = date('H:i:s', array_sum($sumrest));
            

            // dd(array_sum($sumrest));
            return date('H:i:s', array_sum($sumrest));
            // return date('H:i:s', $resttime);
            return $resttime;
            
        // }
    }
}