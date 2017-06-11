<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    public $timestamps = false;
    protected $guarded = array('id');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'created_date', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function Order() {
        return $this->hasMany('Order');
    }

    public static function getUser(){

        $result = DB::table('users')
                ->select('id','email','name', 'created_date', 'status')
                ->orderBy('id', 'asc')
                ->get();

        return $result;
    }

    public static function actUser($id){

        return DB::table('users')->where('id', $id)->update(array('status' => 1));

    }
    
    public static function inactUser($id){

        return DB::table('users')->where('id', $id)->update(array('status' => 0));

    }
    
    public static function delUser($id){

        return DB::table('users')->where('id', $id)->delete();

    }
}
