<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;
class UserController extends Controller
{
    public function change_password(){
        $data['header_title'] = 'Change password';
        return view('profile.change_password',$data);
    }

    public function update_change_password(Request $request){
        // dd($request->all());
        $user = User::getSingle(Auth::user()->id);

        if (Hash::check($request->old_password,$user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success','Password Successfully Updated');
        }
        else
        {
            return redirect()->back()->with('error','Old Password is not Currect');
        }
    }

}
