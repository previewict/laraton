<?php

namespace laraton\Http\Controllers;

use laraton\Http\Requests;
use laraton\Http\Controllers\Controller;
use Auth;
use Lang;
use laraton\User;
use Request;
use Validator;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin()
    {
        $data['menu'] = 'Login';
        return view('auth.login', $data);
    }


    public function postLogin()
    {
        $credentials = array(
            'email' => Request::input('email'),
            'password' => Request::input('password'),
        );

        if (Auth::attempt($credentials))
            return redirect()->intended('home');

        else {
            return redirect('/auth/login')
                ->withInput(Request::only('email', 'remember'))
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

    public function getRegister()
    {
        $data['menu'] = 'Register';
        return view('auth.register', $data);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    public function postRegister()
    {
        $validator = $this->validator(Request::all());

        if ($validator->fails()) {
            return redirect('/user/register')
                ->withInput(Request::all())
                ->withErrors([
                    $validator->messages()->all(),
                ]);
        }

        Auth::login($this->create(Request::all()));

        return redirect('home');
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


}
