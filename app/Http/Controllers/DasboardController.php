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
}
