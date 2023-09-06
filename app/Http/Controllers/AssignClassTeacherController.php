<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\User;
use App\Models\AssignClassTeacher;
use Auth;

class AssignClassTeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = AssignClassTeacher::getRecord();

        $data['header_title'] = "Assign Class Teacher List";
        return view('admin.assign_class_teacher.list',$data);
    }

    // add 

    public function add()
    {
        $data['getTeacher'] = User::getTeacherClass();
        $data['getClass'] = SchoolClass::getClass();
        $data['header_title'] = "Assign Class Teacher Add";
        return view('admin.assign_class_teacher.add',$data);
    }

    //insert

    public function insert(Request $request)
    {
     //   dd($request->all());
        
        if (!empty($request->teacher_id))
        {
            foreach ($request->teacher_id as $teacher_id)
            {
                $getAlreadyFirst = AssignClassTeacher::getAlreadyFirst($request->class_id,$teacher_id);
                if (!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }else
                {
                    $data = new AssignClassTeacher;
                    $data->class_id = $request->class_id;
                    $data->teacher_id = $teacher_id;
                    $data->status = $request->status;
                    $data->created_by = Auth::user()->id;
                    $data->save();
                }

            }

            return redirect('admin/assign_class_teacher/list')->with('success',"Teacher Successfully Asssign to Class");
        }
        else
        {
            return redirect()->back()->with('error','Due to some error please try again');
        }
    }


    
}
