<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Mail;
use Str;

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


    public function forgotpassword(){
        return view('auth.forgot');
    }


    public function PostForgotPassword(Request $request){
        //  dd($request->all());

        $user = User::getEmailSingle($request->email);
        //  dd($getEmailSingle);

        if (!empty($user)) {

            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success','Please Check Your Mail & Reset Your Password');
        }else {
            return redirect()->back()->with('error','This Email Not Found In this System');
        }

    }


    public function reset($remember_token){
        $user = User::getTokenSingle($remember_token);
        // dd($token);

        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset',$data);
        }else {
            abort(404);
        }
    }
  
    public function PostReset($token, Request $request)
    {
        if ($request->password == $request->cpassword)
        {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect('/')->with('success','Password Successfully Reset');
        }
        else
        {
            return redirect()->back()->with('error','Password and Confirm Password does not Match');
        }
    }

    


    
}
