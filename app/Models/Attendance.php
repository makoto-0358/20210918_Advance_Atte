<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['start_time', 'end_time'];

    public static $rules = array(
        'start_time' => 'required',
        'end_time' => 'nullable',
    );

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
