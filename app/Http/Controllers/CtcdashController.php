<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CtcdashController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Administrateur')) {
            return view('back.ctcdashboard.admin');
        } //vue manager à personnaliser plus tard
        elseif (auth()->user()->hasRole('Manager')) {
            return view('back.ctcdashboard.admin');
        } elseif (auth()->user()->hasRole('CST+')) {
            if (request()->query('ctcdashboard') === 'consultant') {
                return view('back.ctcdashboard.cstplus');
            }
            return view('back.ctcdashboard.trunc');
        } else {
            return view('back.ctcdashboard.consultant');
        }
        //return view('back.ctcdashboard.index');
    }

    

    public function summary()
    {
        return view('back.ctcdashboard.summary');
    }
    public function metier()
    {
        return view('back.ctcdashboard.metier');
    }
    public function detail()
    {
        return view('back.ctcdashboard.detail');
    }

    public function tables()
    {
        return view('back.ctcdashboard.tables');
    }

    public function filtrages()
    {
        return view('back.ctcdashboard.filtrages');
    }

    public function vue()
    {
        return view('back.ctcdashboard.vue');
    }

    public function upload()
    {
        return view('back.ctcdashboard.upload');
    }

    public function cdtvue()
    {
        return view('back.ctcdashboard.cdtvue');
    }

    public function oppvue()
    {
        return view('back.ctcdashboard.oppvue');
    }

    public function trgvue()
    {
        return view('back.ctcdashboard.trgvue');
    }

    public function facvue()
    {
        return view('back.ctcdashboard.facvue');
    }

    public function formcdt()
    {
        return view('back.ctcdashboard.formcdt');
    }

    public function formopp()
    {
        return view('back.ctcdashboard.formopp');
    }

    public function canevascdt()
    {
        return view('back.ctcdashboard.canevascdt');
    }

    public function canevasann()
    {
        return view('back.ctcdashboard.canevasann');
    }


    // public function commande($param)
    // {
    //     if ($param == 'optimize') {
    //         \Artisan::call('view:clear');
    //         \Artisan::call('config:clear');
    //         \Artisan::call('route:clear');
    //         \Artisan::call('cache:clear');
    //         \Artisan::call('optimize:clear');
    //     } elseif ($param == 'passport') {
    //         \Artisan::call('passport:install');
    //     } elseif ($param == 'migrate') {
    //         \Artisan::call('migrate:fresh --seed');
    //     } elseif ($param == 'storage') {
    //         \Artisan::call('storage:link');
    //     }

    //     // elseif ($param == 'migrate-no-seed') {
    //     //     \Artisan::call('migrate');
    //     // }
    // }
}


