<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\userReactivate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Modules\UserRoles\Entities\Permission;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'min:7',
        ]);

        $email=$request->email;
        $password=$request->password;
        if (Auth::attempt(['email'=>$email ,'password' => $password ,'verify' => 1]))
        /*$credentials = $request->only('email','phone_number','password');
        if (Auth::attempt($credentials))
        {*/
        {
            if (Auth::user()->role == 'admin' || Auth::user()->role =='superadmin') {
                //user is admin
                return redirect('/adminpanel');
            }
            else{
                //user isn't admin
                return redirect('/home');
            }
        }else{
            return redirect('/login')->with('error','Oops Something is wrong!');
        }
    }
}
