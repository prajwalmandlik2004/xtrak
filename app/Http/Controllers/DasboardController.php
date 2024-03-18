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
    public function commande($param)
    {
        if ($param == 'optimize') {
            \Artisan::call('view:clear');
            \Artisan::call('config:clear');
            \Artisan::call('route:clear');
            \Artisan::call('cache:clear');
            \Artisan::call('optimize:clear');
           
        } elseif ($param == 'passport') {
            \Artisan::call('passport:install');
        } elseif ($param == 'migrate') {
            \Artisan::call('migrate:fresh --seed');
        }
        elseif ($param == 'storage') {
            \Artisan::call('storage:link');
        }
        
       
    }
}
