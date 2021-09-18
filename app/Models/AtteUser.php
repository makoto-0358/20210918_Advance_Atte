<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtteUser extends Model
{
    use HasFactory;

     protected $fillable = ['name', 'mail', 'password'];
    public function times(){
        return $this->hasMany('App\Models\Time');
    }
    public static $rules = array(
        'name' =>'required|text',
        'start_time' => 'date_format:H:i:s',
    );
}
