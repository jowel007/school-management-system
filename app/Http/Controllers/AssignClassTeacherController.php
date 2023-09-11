<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\User;
use App\Models\AssignClassTeacher;
use App\Models\ClassSubject;
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


    public function edit($id){
        $getRecord = AssignClassTeacher::getSingle($id);
        if (!empty($getRecord))
        {
            $data['getRecord'] = $getRecord;
            $data['getAssignTeacherID'] = AssignClassTeacher::getAssignTeacherID($getRecord->class_id);
            $data['getTeacher'] = User::getTeacherClass();
            $data['getClass'] = SchoolClass::getClass();
            $data['header_title'] = "Assign Class Teacher Edit";
            return view('admin.assign_class_teacher.edit',$data);
        }
        else
        {
            abort(404);
        }

    }

    public function update(Request $request,$id)
    {
        // dd($request->all());
        AssignClassTeacher::deleteTeacher($request->class_id);

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
        }

        return redirect('admin/assign_class_teacher/list')->with('success',"Teacher Successfully Asssign to Class Updated");
    }

    public function edit_single($id)
    {
        $getRecord = AssignClassTeacher::getSingle($id);
        if (!empty($getRecord))
        {
            $data['getRecord'] = $getRecord;
            $data['getTeacher'] = User::getTeacherClass();
            $data['getClass'] = SchoolClass::getClass();
            $data['header_title'] = "Assign Class Teacher Edit";
            return view('admin.assign_class_teacher.edit_single',$data);
        }
        else
        {
            abort(404);
        }
    }

    public function update_single(Request $request,$id)
    {
        $getAlreadyFirst = AssignClassTeacher::getAlreadyFirst($request->class_id,$request->teacher_id);
        if (!empty($getAlreadyFirst))
        {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();
            return redirect('admin/assign_class_teacher/list')->with('success',"Status Successfully updated");
        }else
        {
            $data = AssignClassTeacher::getSingle($id);
            $data->class_id = $request->class_id;
            $data->teacher_id = $request->teacher_id;
            $data->status = $request->status;
            $data->save();

            return redirect('admin/assign_class_teacher/list')->with('success',"Teacher Successfully update Asssign to Class");
        }
    }

    public function delete($id)
    {
        $data = AssignClassTeacher::getSingle($id);
        $data->is_delete = 1;
        $data->save();

        return redirect()->back()->with('error','Record Deletd Successfully');
    }


    ///////////////////// techer dashboard side ////////////////////////////////

    public function MyClassSubject()
    {
//        die();
        $data['getRecord'] = AssignClassTeacher::getMyClassSubject(Auth::user()->id);
        $data['header_title'] = 'My Class & Subject';
        return view('teacher.my_class_subject',$data);
    }


}
