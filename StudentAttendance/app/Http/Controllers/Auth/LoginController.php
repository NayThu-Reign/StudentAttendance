<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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

     protected function redirectTo()
     {
         if (Auth::guard('web')->check()) {
             return '/admin';
         }

         elseif (Auth::guard('student')-> check()) {
            return '/' ;
         } else {
            return 'login';
         }
     }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // /**
    //  * Handle a login request to the application.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */



    protected function attemptLogin(Request $request)
    {
        // Attempt to log in as an admin
        if (Auth::guard('web')->attempt($this->credentials($request), $request->filled('remember'))) {
            return true;
        }

        // Attempt to log in as a student
        if (Auth::guard('student')->attempt($this->credentials($request), $request->filled('remember'))) {
            return true;
        }

        return false;
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
