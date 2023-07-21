<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
class AuthController extends Controller
{
    public function login(){
        if (!empty(Auth::check()))
        {
            if (Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard');
            }
            elseif (Auth::user()->user_type == 2)
            {
                return redirect('teacher/dashboard');
            }
            elseif (Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }
            elseif (Auth::user()->user_type == 4)
            {
                return redirect('parent/dashboard');
            }
        }
    //    dd(Hash::make(12345678));
        return view('auth.login');
    }

    public function Authlogin(Request $request){
    //    dd($request->all());
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password],$remember))
        {
            if (Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard');
            }
            elseif (Auth::user()->user_type == 2)
            {
                return redirect('teacher/dashboard');
            }
            elseif (Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }
            elseif (Auth::user()->user_type == 4)
            {
                return redirect('parent/dashboard');
            }

        }else{
            return redirect()->back()->with('error','Please enter Currect Email & Password');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }
}
