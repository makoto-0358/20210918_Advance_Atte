<?php

namespace App\Http\Controllers;

use App\Models\Rest;
use Illuminate\Support\facades\Auth;
use App\Models\Attendance;
use Illuminate\Http\Request;

class restController extends Controller
{
    public function start(Request $request){
        // $this->validate($request, Rest::$rules);
        $form = $request->all();
        $form['attendance_id'] = Attendance()->latest('id')->first();
        dd($form);
        Rest::create($form);
        return redirect('');
    }
    public function end(Request $request){
        // $this->validate($request, Rest::rules);
        $form = $request->all();
        $form['end_time'] = now();
        unset($form["_token"]);
        $rest = Rest::where('attendance_id', Auth::user()->id)->latest('id')->first()->update($form);
        return redirect('');
    }
}