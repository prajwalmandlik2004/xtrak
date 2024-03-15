<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class DasboardController extends Controller
{
    public function index()
    {
        return view('back.dashboard.index');
    }
    public function connected()
    {
        if (auth()->user()->hasRole('Administrateur')) {
            $this->authorize('Liste des candidats');
            return view('back.candidates.index');
        } else {
            $this->authorize('Ajouter un candidat');
            return view('back.candidates.form', [
                'action' => 'create',
                'candidate' => new Candidate(),
            ]);
        }
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
        }elseif ($param == 'vite') {
            \Artisan::call('npm run build');
        }
        elseif ($param == 'composer') {
            \Artisan::call('composer2 install');
            echo "yes";
        }
    }
}
