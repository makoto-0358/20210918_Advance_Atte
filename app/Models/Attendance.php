<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    protected $fillable = ['date', 'start_time', 'closing_time'];
    public static $rules = array(
        'date' =>'required|date_format:Y-m-d',
        'start_time' => 'date_format:H:i:s',
    );
}
