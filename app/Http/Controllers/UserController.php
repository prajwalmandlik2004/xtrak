<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('back.users.index');
    }
    public function profile()
    {
        return view('back.users.profile');
    }
}
