<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\User;
use Illuminate\Support\facades\Auth;

class AtteUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $items = User::pagenete(4);
        $param = ['items' => $items, 'user' => $user];
        return view('index', $param);
    }
    public function check(Request $request)
    {
        $text = ['text' => 'ログインしてください。'];
        return view('auth', $text);
    }
    public function checkUser(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email], ['password' => $password])){
            $text = Auth::user()->name.'さんがログインしました';
        }else{
            $text = 'ログインに失敗しました';
        }
        return view('auth', ['text' => $text]);
    }
}