<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function start(Request $request){
        // $this->validate($request, Attendance::$rules);
        $form = $request->all();
        $form['user_id'] = Auth::user()->id;
        Attendance::create($form);
        return redirect('');
    }
    public function end(Request $request){
        // $this->validate($request, Attendance::rules);
        $form = $request->all();
        unset($form["_token"]);
        Attendance::where('user_id',Auth::user()->id)->latest('id')->first()->update($form);
        return redirect('');
    }
}
