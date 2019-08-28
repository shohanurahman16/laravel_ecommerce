<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\VerifyRegistration;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/';

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
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if($user->status == 1) {

            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                return redirect()->intended(route('index'));
            } else {
                Session::flash('error', 'Account Mismatch');
                return back();
            }
        }else{
            if(!is_null($user))
            {
                $user->notify(new VerifyRegistration($user));
                Session::flash('success', 'You are not verified.. A new verification link has been sent to your mail.. please verify your email');
                return redirect()->route('login');
            }
            else
            {
                Session::flash('error', 'Account Mismatch');
                return redirect()->route('login');
            }
        }

    }
}
