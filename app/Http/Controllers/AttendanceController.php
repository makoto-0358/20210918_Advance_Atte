<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function start(Request $request){
        $this->validate($request, Attendance::rules);
        $form = $request->all();
        Attendance::create($form);
        return redirect('');
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
