<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignClassTeacher extends Model
{
    use HasFactory;

    protected $table= 'assign_class_teacher';

    static public function getAlreadyFirst($class_id,$teacher_id){
        return self::where('class_id' ,'=', $class_id)->where('teacher_id' ,'=', $teacher_id)->first();
    }


    static public function getRecord()
    {
        $return = self::select('assign_class_teacher.*','school_classes.name as class_name','teacher.name as teacher_name','users.name as created_by_name')

                    ->join('users as teacher','teacher.id', '=','assign_class_teacher.teacher_id')
                    ->join('school_classes','school_classes.id', '=','assign_class_teacher.class_id')
                    ->join('users','users.id', '=','assign_class_teacher.created_by')
                    ->where('assign_class_teacher.is_delete','=',0);


            $return = $return->orderBy('assign_class_teacher.id','desc')
                    ->paginate(100);

            return  $return;
    }



}
