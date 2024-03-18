<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class DasboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Administrateur')) {
            return view('back.dashboard.admin');
        } else {
            return view('back.dashboard.consultant');
        }
        //return view('back.dashboard.index');
    }
}
