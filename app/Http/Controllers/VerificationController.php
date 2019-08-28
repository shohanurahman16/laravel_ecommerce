<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerificationController extends Controller
{
    //
    public function verify($token){
        $user = User::where('remember_token', $token)->first();
        if (!is_null($user)){

            $user->status = 1;
            $user->remember_token = NULL;
            $user->save();
            Session::flash('success_registration', 'You are registered successfully..Login Now');
            return redirect('login');
        }
        else{
            Session::flash('error', 'Your link is not valid anymore');
            return redirect('/');
        }


    }
}
