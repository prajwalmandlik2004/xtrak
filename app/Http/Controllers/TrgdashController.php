<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class TrgdashController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Administrateur')) {
            return view('back.trgdashboard.admin');
        } //vue manager à personnaliser plus tard
        elseif (auth()->user()->hasRole('Manager')) {
            return view('back.trgdashboard.admin');
        } elseif (auth()->user()->hasRole('CST+')) {
            if (request()->query('trgdashboard') === 'consultant') {
                return view('back.trgdashboard.cstplus');
            }
            return view('back.trgdashboard.trunc');
        } else {
            return view('back.trgdashboard.consultant');
        }
        //return view('back.trgdashboard.index');
    }

    

    public function summary()
    {
        return view('back.trgdashboard.summary');
    }
    public function metier()
    {
        return view('back.trgdashboard.metier');
    }
    public function detail()
    {
        return view('back.trgdashboard.detail');
    }

    public function tables()
    {
        return view('back.trgdashboard.tables');
    }

    public function filtrages()
    {
        return view('back.trgdashboard.filtrages');
    }

    public function vue()
    {
        return view('back.trgdashboard.vue');
    }

    public function upload()
    {
        return view('back.trgdashboard.upload');
    }

    public function cdtvue()
    {
        return view('back.trgdashboard.cdtvue');
    }

    public function oppvue()
    {
        return view('back.trgdashboard.oppvue');
    }

    public function trgvue()
    {
        return view('back.trgdashboard.trgvue');
    }

    public function facvue()
    {
        return view('back.trgdashboard.facvue');
    }

    public function formcdt()
    {
        return view('back.trgdashboard.formcdt');
    }

    public function formopp()
    {
        return view('back.trgdashboard.formopp');
    }

    public function canevascdt()
    {
        return view('back.trgdashboard.canevascdt');
    }

    public function canevasann()
    {
        return view('back.trgdashboard.canevasann');
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


