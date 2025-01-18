<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class OppdashController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Administrateur')) {
            return view('back.oppdashboard.admin');
        } //vue manager à personnaliser plus tard
        elseif (auth()->user()->hasRole('Manager')) {
            return view('back.oppdashboard.admin');
        } elseif (auth()->user()->hasRole('CST+')) {
            if (request()->query('oppdashboard') === 'consultant') {
                return view('back.oppdashboard.cstplus');
            }
            return view('back.oppdashboard.trunc');
        } else {
            return view('back.oppdashboard.consultant');
        }
        //return view('back.oppdashboard.index');
    }

    

    public function summary()
    {
        return view('back.oppdashboard.summary');
    }
    public function metier()
    {
        return view('back.oppdashboard.metier');
    }
    public function detail()
    {
        return view('back.oppdashboard.detail');
    }

    // public function landings()
    // {
    //     return view('back.oppdashboard.landings');
    // }

    public function tables()
    {
        return view('back.oppdashboard.tables');
    }

    public function filtrages()
    {
        return view('back.oppdashboard.filtrages');
    }

    public function vue()
    {
        return view('back.oppdashboard.vue');
    }

    public function upload()
    {
        return view('back.oppdashboard.upload');
    }

    public function cdtvue()
    {
        return view('back.oppdashboard.cdtvue');

        // if (auth()->user()->hasRole('Administrateur')) {
        //     return view('back.oppdashboard.cdtvue');
        // } //vue manager à personnaliser plus tard
        // elseif (auth()->user()->hasRole('Manager')) {
        //     return view('back.oppdashboard.cdtvue');
        // } else {
        //     return view('back.oppdashboard.cdtvue');
        // }
    }

    public function oppvue()
    {
        return view('back.oppdashboard.oppvue');

        // if (auth()->user()->hasRole('Administrateur')) {
        //     return view('back.oppdashboard.oppvue');
        // } //vue manager à personnaliser plus tard
        // elseif (auth()->user()->hasRole('Manager')) {
        //     return view('back.oppdashboard.oppvue');
        // } else {
        //    return view('back.oppdashboard.oppvue');
        // }
    }

    public function trgvue()
    {
        return view('back.oppdashboard.trgvue');
    }

    public function facvue()
    {
        return view('back.oppdashboard.facvue');
    }

    public function formcdt()
    {
        return view('back.oppdashboard.formcdt');
    }

    public function formopp()
    {
        return view('back.oppdashboard.formopp');
    }

    public function canevascdt()
    {
        return view('back.oppdashboard.canevascdt');
    }

    public function canevasann()
    {
        return view('back.oppdashboard.canevasann');
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
        } elseif ($param == 'storage') {
            \Artisan::call('storage:link');
        }

        // elseif ($param == 'migrate-no-seed') {
        //     \Artisan::call('migrate');
        // }
    }
}


