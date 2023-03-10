<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Validation\ValidationException;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    use AuthenticatesUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMINHOME;
    protected $maxAttempts = 3;
    protected $decayMinutes = 5;


    /**
     * The number of minutes to throttle for.
     *
     * @return int
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view("admin.auth.login");
    } //



    public function authenticate(Request $request)
    {

        //$this->clearLoginAttempts($request);
        //Session::forget('error');
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        // if (
        //     method_exists($this, 'hasTooManyLoginAttempts') &&
        //     $this->hasTooManyLoginAttempts($request)
        // ) {
        //     $this->fireLockoutEvent($request);
        //     //print_r($this->sendLockoutResponse($request));
        //     $seconds = $this->limiter()->availableIn(
        //         $this->throttleKey($request)
        //     );
        //     return redirect()->back()->with('error', 'To Many Attempt Please Try After ' . ceil($seconds / 60) . ' Minute');
        // }

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => 1])) {
           // $this->clearLoginAttempts($request);
            return redirect()->route('admin.dashboard');
        } else {
            //$this->incrementLoginAttempts($request);

            return redirect()->back()->with('error', 'Username and password not matched');
        }
    }
}
