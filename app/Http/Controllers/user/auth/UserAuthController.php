<?php

namespace App\Http\Controllers\user\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;

class UserAuthController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

   // protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
           public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view("user.auth.login");
    }//

    public function authenticate(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        


        if(Auth::guard('user')->attempt(['email' => $request->email,'password' => $request->password])){
            
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'Username and password not matched');
    }

    
    
}
