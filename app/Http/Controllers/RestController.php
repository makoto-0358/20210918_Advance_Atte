<?php

namespace App\Http\Controllers;

use App\Models\Rest;
use Illuminate\Http\Request;

class RestController extends Controller
{
    public function start(Request $request){
        $this->validate($request, Rest::rules);
        $form = $request->all();
        Rest::create($form);
        return redirect('');
    }
    public function end(Request $request){
        $attendance = Rest::find($request->id);
        $this->validate($request, Rest::rules);
        $form = $request->all();
        unset($form["_token"]);
        Rest::update($form);
        return redirect('');
    }
}
