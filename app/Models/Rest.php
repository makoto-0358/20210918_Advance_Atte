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

    public function Attendance(){
        return $this->belongsTo('App\Models\Attendance');
    }
    protected $fillable = ['start_time', 'end_time'];
}
