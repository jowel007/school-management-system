<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ClassSubject;
use App\Models\SchoolClass;
use App\Models\Subject;

class ClassSubjectController extends Controller
{
    public function list(Request $request){
        $data['getRecord'] = ClassSubject::getRecord();

        $data['header_title'] = "Assign Subject List";
        return view('admin.assign_subject.list',$data);
    }

    public function add(Request $request){
        $data['getClass'] = SchoolClass::getClass();
        $data['getSubject'] = Subject::getSubject();
        $data['header_title'] = "Assign Subject Add";
        return view('admin.assign_subject.add',$data);
    }

    public function insert(Request $request){
       // dd($request->all());

        if (!empty($request->subject_id))
        {
            foreach ($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id,$subject_id);
                if (!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }else
                {
                    $data = new ClassSubject;
                    $data->class_id = $request->class_id;
                    $data->subject_id = $subject_id;
                    $data->status = $request->status;
                    $data->created_by = Auth::user()->id;
                    $data->save();
                }



            }

            return redirect('admin/assign_subject/list')->with('success',"Subject Successfully Asssign to Class");
        }
        else
        {
            return redirect()->back()->with('error','Due to some error please try again');
        }

    }

    public function edit($id){
        $getRecord = ClassSubject::getSingle($id);
        if (!empty($getRecord))
        {
            $data['getRecord'] = $getRecord;
            $data['getSingleSubjectID'] = ClassSubject::getSingleSubjectID($getRecord->class_id);
            $data['getClass'] = SchoolClass::getClass();
            $data['getSubject'] = Subject::getSubject();
            $data['header_title'] = "Assign Subject Edit";
            return view('admin.assign_subject.edit',$data);
        }
        else
        {
            abort(404);
        }

    }

        public function update(Request $request)
        {

            ClassSubject::deleteSubject($request->class_id);

            if (!empty($request->subject_id))
            {
                foreach ($request->subject_id as $subject_id)
                {
                    $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id,$subject_id);
                    if (!empty($getAlreadyFirst))
                    {
                        $getAlreadyFirst->status = $request->status;
                        $getAlreadyFirst->save();
                    }else
                    {
                        $data = new ClassSubject;
                        $data->class_id = $request->class_id;
                        $data->subject_id = $subject_id;
                        $data->status = $request->status;
                        $data->created_by = Auth::user()->id;
                        $data->save();
                    }

                }

            }

            return redirect('admin/assign_subject/list')->with('success',"Subject Successfully Asssign to Class");

        }

        public function delete($id){

            $data = ClassSubject::getSingle($id);
            $data->is_delete = 1;
            $data->save();

            return redirect()->back()->with('error','Record Deletd Successfully');
        }

        public function edit_single($id){

            $getRecord = ClassSubject::getSingle($id);
            if (!empty($getRecord))
            {
                $data['getRecord'] = $getRecord;
                $data['getClass'] = SchoolClass::getClass();
                $data['getSubject'] = Subject::getSubject();
                $data['header_title'] = "Assign Subject Edit";
                return view('admin.assign_subject.edit_single',$data);
            }
            else
            {
                abort(404);
            }
        }

        public function update_single(Request $request, $id)
        {
                    $getAlreadyFirst = ClassSubject::getAlreadyFirst($request->class_id,$request->subject_id);
                    if (!empty($getAlreadyFirst))
                    {
                        $getAlreadyFirst->status = $request->status;
                        $getAlreadyFirst->save();
                        return redirect('admin/assign_subject/list')->with('success',"Status Successfully updated");
                    }else
                    {
                        $data = ClassSubject::getSingle($id);
                        $data->class_id = $request->class_id;
                        $data->subject_id = $request->subject_id;
                        $data->status = $request->status;
                        $data->save();

                        return redirect('admin/assign_subject/list')->with('success',"Subject Successfully Asssign to Class");
                    }

        }


}
