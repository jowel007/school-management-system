<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\SchoolClass;

class ClassController extends Controller
{
    public function list(){
        $data['getRecord'] = SchoolClass::getRecord();

        $data['header_title'] = "Class List";
        return view('admin.class.list',$data);
    }

    public function add(){
        $data['header_title'] = "Add  Class";
        return view('admin.class.add',$data);
    }

    public function insert(Request $request){
        // dd($request->all());
        $data = new SchoolClass;
        $data->name = $request->name;
        $data->status = $request->status;
        $data->created_by = Auth::user()->id;
        $data->save();

        return redirect('admin/class/list')->with('success','Class created Successfully');

    }

    public function edit($id){

        $data['getRecord'] = SchoolClass::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Class";
            return view('admin.class.edit',$data);
        }else {
            abort(404);
        }
        
    }

    public function update($id, Request $request){

        $data = SchoolClass::getSingle($id);
        $data->name = $request->name;
        $data->status = $request->status;
        $data->save();

        return redirect('admin/class/list')->with('success','Class updated Successfully');
    }

    public function delete($id){
        $data = SchoolClass::getSingle($id);
        $data->is_delete = 1;
        $data->save();

        return redirect()->back()->with('error','Class Deletd Successfully');
    }


}
