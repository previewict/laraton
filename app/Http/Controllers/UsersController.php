<?php

namespace laraton\Http\Controllers;

use Illuminate\Http\Request;
use laraton\Http\Requests;
use laraton\Http\Controllers\Controller;
use Auth;
use Lang;

class UsersController extends Controller
{

    public function getLogin()
    {
        $data['menu'] = 'Login';
        return view('auth.login', $data);
    }


    public function postLogin(Request $request)
    {
        $credentials = array(
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        );

        if (Auth::attempt($credentials))
            return redirect()->intended('home');

        else {
            return redirect('/auth/login')
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    $this->getFailedLoginMessage(),
                ]);
        }
    }

    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
            ? Lang::get('auth.failed')
            : 'These credentials do not match our records.';
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect('/');
    }


}
