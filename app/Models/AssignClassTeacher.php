<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
class AssignClassTeacher extends Model
{
    use HasFactory;

    protected $table= 'assign_class_teacher';

    static public function getAlreadyFirst($class_id,$teacher_id){
        return self::where('class_id' ,'=', $class_id)->where('teacher_id' ,'=', $teacher_id)->first();
    }

    static public function getAssignTeacherID($class_id)
    {
        return self::where('class_id','=',$class_id)->where('is_delete','=',0)->get();
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }


    static public function getRecord()
    {
        $return = self::select('assign_class_teacher.*','school_classes.name as class_name','teacher.name as teacher_name','users.name as created_by_name')

                    ->join('users as teacher','teacher.id', '=','assign_class_teacher.teacher_id')
                    ->join('school_classes','school_classes.id', '=','assign_class_teacher.class_id')
                    ->join('users','users.id', '=','assign_class_teacher.created_by')
                    ->where('assign_class_teacher.is_delete','=',0);
                //filter
                    if (!empty(Request::get('class_name'))) {
                        $return = $return->where('school_classes.name','like','%'.Request::get('class_name').'%');
                    }

                    if (!empty(Request::get('teacher_name'))) {
                        $return = $return->where('teacher.name','like','%'.Request::get('teacher_name').'%');
                    }

                    if (!empty(Request::get('status'))) {
                        $status = (Request::get('status') == 100) ? 0 : 1;
                        $return = $return->where('assign_class_teacher.status', '=', $status);
                    }

                    if (!empty(Request::get('date'))){
                        $return = $return->whereDate('assign_class_teacher.created_at','=',Request::get('date'));
                    }

            $return = $return->orderBy('assign_class_teacher.id','desc')
                    ->paginate(100);

            return  $return;
    }

    static public function deleteTeacher($class_id)
    {
        return self::where('class_id','=',$class_id)->delete();
    }

    // techer dashboard side

    static public function getMyClassSubject($teacher_id)
    {
        return self::select('assign_class_teacher.*','school_classes.name as class_name','subjects.name as subject_name','subjects.type as subject_type')
            ->join('school_classes','school_classes.id', '=','assign_class_teacher.class_id')
            ->join('class_subjects','class_subjects.class_id', '=','school_classes.id')
            ->join('subjects','subjects.id', '=','class_subjects.subject_id')
            ->where('assign_class_teacher.is_delete','=',0)
            ->where('assign_class_teacher.status','=',0)
            ->where('subjects.status','=',0)
            ->where('subjects.is_delete','=',0)
            ->where('class_subjects.status','=',0)
            ->where('class_subjects.is_delete','=',0)
            ->where('assign_class_teacher.teacher_id','=',$teacher_id)
            ->get();
    }



}
