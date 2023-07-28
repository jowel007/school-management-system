<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
class SchoolClass extends Model
{
    use HasFactory;

    protected $guarded = [];

    static public function getRecord(){
        $return = SchoolClass::select('school_classes.*','users.name as created_by_name')
                    ->join('users','users.id','school_classes.created_by');
                    // for filter
                    if (!empty(Request::get('name'))) {
                        $return = $return->where('school_classes.name','like','%'.Request::get('name').'%');
                    }

                    if (!empty(Request::get('date'))){
                        $return = $return->whereDate('school_classes.created_at','=',Request::get('date'));
                    }

                $return = $return->where('school_classes.is_delete','=',0)
                    ->orderBy('school_classes.id','desc')
                    ->paginate(10);

        return $return;
    }

    static public function getSingle($id){
        return self::find($id);
    }

}
