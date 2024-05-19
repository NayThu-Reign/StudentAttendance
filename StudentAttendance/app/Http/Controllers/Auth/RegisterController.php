<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
    //  * @return \App\Models\Student
     */
    protected function register(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|unique:users,email|max:255',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        $validator = validator(request()->all(), [
            "name" => "required",
            "email" => "required",
            "password" => "required",
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        $isAdmin = Str::endsWith($request->email, '@admin.gmail.com');

        if($isAdmin) {
            $user = new User();
            $user->name = request()->name;
            $user->email = request()->email;
            $user->email = request()->email;
            $user->password = request()->password;

            $user->save();
            return back()->with('success', 'new admin created');

        } else {
            return back()->with("err", "admin gmail should ends with '@admin.gmail.com'" );
        }

    }
}
