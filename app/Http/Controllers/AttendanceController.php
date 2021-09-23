<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Support\facades\Auth;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function start(Request $request){
        $this->validate($request, Attendance::$rules);
        $form = $request->all();
        $form['user_id'] = Auth::user()->id;
        Attendance::create($form);
        return view('welcome');
    }
    public function end(Request $request){
        $attendance = attendance::find($request->id);
        $this->validate($request, Attendance::rules);
        $form = $request->all();
        unset($form["_token"]);
        Attendance::update($form);
        return redirect('');
    }
}
