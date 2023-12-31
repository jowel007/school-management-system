<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ClassSubject;
use App\Models\User;
use Auth;


class SubjectController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Subject::getRecord();
        $data['header_title'] = "Subject List";
        return view('admin.subject.list',$data);
    }

    public function add()
    {
        $data['header_title'] = "Add  subject";
        return view('admin.subject.add',$data);
    }

    public function insert(Request $request)
    {
    //  dd($request->all());
        $data = new Subject;
        $data->name = trim($request->name);
        $data->type = trim($request->type);
        $data->status = trim($request->status);
        $data->created_by = Auth::user()->id;
        $data->save();

        return redirect('admin/subject/list')->with('success','Subject created Successfully');
    }

    public function edit($id){

        $data['getRecord'] = Subject::getSingle($id);

        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Subject";
            return view('admin.subject.edit',$data);
        }else {
            abort(404);
        }

    }

    public function update($id,Request $request)
    {
        $data = Subject::getSingle($id);
        $data->name = trim($request->name);
        $data->type = trim($request->type);
        $data->status = trim($request->status);
        $data->created_by = Auth::user()->id;
        $data->save();

        return redirect('admin/subject/list')->with('success','Subject updated Successfully');
    }

    public function delete($id)
    {
        $data = Subject::getSingle($id);
        $data->is_delete = 1;
        $data->save();

        return redirect()->back()->with('error','Subject Deletd Successfully');
    }

    // student side

    public function MySubject()
    {
        // dd(Auth::user()->class_id);
        $data['MySubject'] = ClassSubject::MySubject(Auth::user()->class_id);
        $data['header_title'] = "My Subject List";
        return view('student.my_subject',$data);
    }

    // parent side
    public function ParentStudentSubejct($student_id)
    {
        // dd($student_id);
        $user = User::getSingle($student_id);
        $data['getUser'] = $user;
        $data['getRecord'] = ClassSubject::MySubject($user->class_id);
        $data['header_title'] = "My Student Subject List";
        return view('parent.my_student_subject',$data);
    }



}
