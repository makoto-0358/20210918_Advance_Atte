<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
