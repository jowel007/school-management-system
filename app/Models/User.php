<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getAdmin()
    {
        $return = self::select('users.*')
            ->where('user_type','=',1)
            ->where('is_delete','=',0);

            //filter
        if (!empty(Request::get('name')))
        {
            $return = $return->where('name','like','%'.Request::get('name').'%');
        }
        if (!empty(Request::get('email')))
        {
            $return = $return->where('email','like','%'.Request::get('email').'%');
        }

        if (!empty(Request::get('date')))
        {
            $return = $return->whereDate('created_at','=',Request::get('date'));
        }
            $return = $return ->orderBy('id','desc')
            ->paginate(10);
            return $return;
    }

    static public function getParent()
    {
        $return = self::select('users.*')
            ->where('user_type','=',4)
            ->where('is_delete','=',0);

            //filter
        if (!empty(Request::get('name')))
        {
            $return = $return->where('users.name','like','%'.Request::get('name').'%');
        }

        if (!empty(Request::get('lastname')))
        {
            $return = $return->where('users.lastname','like','%'.Request::get('lastname').'%');
        }

        if (!empty(Request::get('email')))
        {
            $return = $return->where('users.email','like','%'.Request::get('email').'%');
        }


        if (!empty(Request::get('gender')))
        {
            $return = $return->where('users.gender','=',Request::get('gender'));
        }

        if (!empty(Request::get('ooccupation')))
        {
            $return = $return->where('users.ooccupation','like','%'.Request::get('ooccupation').'%');
        }
        if (!empty(Request::get('address')))
        {
            $return = $return->where('users.address','like','%'.Request::get('address').'%');
        }
        if (!empty(Request::get('mobile_number')))
        {
            $return = $return->where('users.mobile_number','like','%'.Request::get('mobile_number').'%');
        }

        if (!empty(Request::get('date')))
        {
            $return = $return->whereDate('users.created_at','like','='.Request::get('created_at').'%');
        }

        if (!empty(Request::get('status')))
        {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $return = $return->where('users.status','like','=',$status);
        }


            $return = $return ->orderBy('id','desc')
            ->paginate(10);
            return $return;
    }


    static public function getStudent()
    {
        $return = self::select('users.*','school_classes.name as class_name','parent.name as parent_name' ,'parent.last_name as parent_last_name')
            ->join('users as parent','parent.id','=','users.parent_id','left')
            ->join('school_classes','school_classes.id','=','users.class_id','left')
            ->where('users.user_type','=',3)
            ->where('users.is_delete','=',0);

                //filter
        if (!empty(Request::get('name')))
        {
            $return = $return->where('users.name','like','%'.Request::get('name').'%');
        }

        if (!empty(Request::get('lastname')))
        {
            $return = $return->where('users.lastname','like','%'.Request::get('lastname').'%');
        }

        if (!empty(Request::get('email')))
        {
            $return = $return->where('users.email','like','%'.Request::get('email').'%');
        }

        if (!empty(Request::get('admission_number')))
        {
            $return = $return->where('users.admission_number','like','%'.Request::get('admission_number').'%');
        }

        if (!empty(Request::get('roll_number')))
        {
            $return = $return->where('users.roll_number','like','%'.Request::get('roll_number').'%');
        }

        if (!empty(Request::get('class')))
        {
            $return = $return->where('users.class','like','%'.Request::get('class').'%');
        }

        if (!empty(Request::get('gender')))
        {
            $return = $return->where('users.gender','=',Request::get('gender'));
        }

        if (!empty(Request::get('cast')))
        {
            $return = $return->where('users.cast','like','%'.Request::get('cast').'%');
        }
        if (!empty(Request::get('religion')))
        {
            $return = $return->where('users.religion','like','%'.Request::get('religion').'%');
        }
        if (!empty(Request::get('mobile_number')))
        {
            $return = $return->where('users.mobile_number','like','%'.Request::get('mobile_number').'%');
        }
        if (!empty(Request::get('blood_group')))
        {
            $return = $return->where('users.blood_group','like','%'.Request::get('blood_group').'%');
        }

        if (!empty(Request::get('admission_date')))
        {
            $return = $return->whereDate('users.admission_date','like','%'.Request::get('admission_date').'%');
        }

        if (!empty(Request::get('date')))
        {
            $return = $return->whereDate('users.created_at','like','='.Request::get('created_at').'%');
        }

        if (!empty(Request::get('status')))
        {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $return = $return->where('users.status','like','=',$status);
        }

        $return = $return ->orderBy('users.id','desc')
            ->paginate(10);
        return $return;
    }


    static public function getSearchStudent(){
        // dd(Request::all());
        if(!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('lastname')) || !empty(Request::get('email')))
        {
            $return = self::select('users.*','school_classes.name as class_name','parent.name as parent_name')
            ->join('users as parent','parent.id','=','users.parent_id','left')   // join query for assign student parents
            ->join('school_classes','school_classes.id','=','users.class_id','left')
            ->where('users.user_type','=',3)
            ->where('users.is_delete','=',0);

                //filter
        if (!empty(Request::get('id')))
            {
                $return = $return->where('users.id','like',Request::get('id'));
            }
            
        if (!empty(Request::get('name')))
        {
            $return = $return->where('users.name','like','%'.Request::get('name').'%');
        }

        if (!empty(Request::get('lastname')))
        {
            $return = $return->where('users.lastname','like','%'.Request::get('lastname').'%');
        }

        if (!empty(Request::get('email')))
        {
            $return = $return->where('users.email','like','%'.Request::get('email').'%');
        }

        $return = $return ->orderBy('users.id','desc')
            ->limit(10)
            ->get();
        return $return;
        }
    }


    static public function getMyStudent($parent_id){

        $return = self::select('users.*','school_classes.name as class_name','parent.name as parent_name')
            ->join('users as parent','parent.id','=','users.parent_id','left') 
            ->join('school_classes','school_classes.id','=','users.class_id','left')
            ->where('users.user_type','=',3)
            ->where('users.parent_id','=',$parent_id)
            ->where('users.is_delete','=',0)
            ->orderBy('users.id','desc')
            ->get();
        return $return;

    }


    static public function getEmailSingle($email){
        return User::where('email', '=', $email)->first();
    }

    static public function getTokenSingle($remember_token){
        return User::where('remember_token', '=', $remember_token)->first();
    }

    public function getProfile(){
        if (!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
        {
            return url('upload/profile/'.$this->profile_pic);
        }
        else
        {
            return "";
        }
    }










}
