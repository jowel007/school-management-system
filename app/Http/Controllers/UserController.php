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

    public function MyAccount(){
                    //for teacher
        // $data['getRecord'] = User::getSingle(Auth::user()->id);
        // $data['header_title'] = 'My Account';
        // return view('teacher.my_account',$data);

        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = 'My Account';
        if (Auth::user()->user_type == 2 ) {

            return view('teacher.my_account',$data);

        }elseif (Auth::user()->user_type == 3) {

            return view('student.my_account',$data);

        }elseif (Auth::user()->user_type == 4) {

            return view('parent.my_account',$data);

        }
    }

    public function UpdateMyParentsAccount(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_number' => 'max:15|min:8',
            'address' => 'max:255',
            'occupation' => 'max:255'
        ]);

        // dd($request->all());
        $student = User::getSingle($id);

        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);
        $student->occupation = trim($request->occupation);
        $student->address = trim($request->address);

        if (!empty($request->file('profile_pic')))
        {
            if (!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_pic);
            }

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr =date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);

            $student->profile_pic = $filename;
        }
        $student->mobile_number =trim($request->mobile_number);
        $student->email = trim($request->email);
        $student->save();

        return redirect()->back()->with('info','Parents Accounts Updated Successfully Done');
    }

    public function UpdateMyStudentAccount(Request $request)
    {
        // dd($request->all());
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'weight' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:8',
            'cast' => 'max:50',
            'religion' => 'max:50',
            'height' => 'max:10',
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);


        if (!empty($request->date_of_birth))
        {
            $student->date_of_birth = trim($request->date_of_birth);
        }


        if (!empty($request->file('profile_pic')))
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr =date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);

            $student->profile_pic = $filename;
        }

        $student->cast = trim($request->cast);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->email = trim($request->email);
        $student->save();

        return redirect()->back()->with('info','Student Account Updated Successfully Done');

    }


    public function UpdateMyAccount(Request $request)
    {

        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_number' => 'max:15|min:8',
            'marital_status' => 'max:50',
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);


        if (!empty($request->date_of_birth))
        {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }


        if (!empty($request->file('profile_pic')))
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr =date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);

            $teacher->profile_pic = $filename;
        }

        $teacher->marital_status = trim($request->marital_status);
        $teacher->address = trim($request->address);
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->current_address = trim($request->current_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experiance = trim($request->work_experiance);
        $teacher->email = trim($request->email);
        $teacher->save();

        return redirect()->back()->with('info','Account Updated Successfully Done');

    }




}
