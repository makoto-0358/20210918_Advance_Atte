<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    public static $rules = array(
        'attendance_id' => 'required',
    );

    // public function getRestingTimeAttribute(){
    //     $time = strtotime($this->end_time) - strtotime($this->start_time) + strtotime('1970-01-01');
    //     return $time;
    // }

    public function Attendance(){
        return $this->belongsTo('App\Models\Attendance');
    }
}
