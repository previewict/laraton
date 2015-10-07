<?php

namespace laraton\Http\Controllers;

use Illuminate\Http\Request;
use laraton\Http\Requests;
use laraton\Http\Controllers\Controller;

class UsersController extends Controller
{

    public function getLogin()
    {
        $data['menu'] = 'Login';
        return view('auth.login', $data);
    }


}
