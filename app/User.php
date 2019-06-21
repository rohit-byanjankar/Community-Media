<?php

namespace App;

use App\Http\Resources\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Modules\UserRoles\Entities\Permission;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $connection='mysql2';
    protected $fillable = [
        'name', 'email', 'password','about', 'image','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function posts()
    {
        //return $this->hasMany('App\Post');
        return $this->hasMany(Post::class);
    }

    public function getPermissions(){
        return ["delete", "update", "create", "view"];
    }

    public function getCustomAttribute()
    {
        $userRole = Auth::user()->role; //get the role of the user who just login
        $permissions = Permission::where('role',$userRole)->select('model','permission_granted')->get(); /*get the permission of the
            role which the logged in user belongs to*/

        $permission_granted=[];
        foreach ($permissions as $permission){
            {
                $role=$userRole;
                if(!isset($permission_granted[$role])){
                    $permission_granted[$role]=[];
                }

                $model=$permission->model;
                if(!isset($permission_granted[$role][$model])){
                    $permission_granted[$role][$model]=[];
                }

                $permission_available=$permission->permission_granted;
                array_push($permission_granted[$role][$model],$permission_available);
            }
        }
        return $permission_granted;
    }
}


