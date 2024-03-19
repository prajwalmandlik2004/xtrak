<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('Liste des candidats');
        return view('back.candidates.index');
    }
    public function uploaded()
    {
        return view('back.candidates.uploaded');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('Ajouter un candidat');
        return view('back.candidates.form', [
            'action' => 'create',
            'candidate' => new Candidate(),
        ]);
    }
    public function edit(Candidate $candidate)
    {
        $this->authorize('Modifier un candidat');
        return view('back.candidates.form', [
            'action' => 'update',
            'candidate' => $candidate,
        ]);
    }
    public function show(Candidate $candidate)
    {
        $this->authorize('Voir un candidat');
        return view('back.candidates.show', [
            'candidate' => $candidate,
        ]);
    }

    public function import()
    {
        $this->authorize('Importer des candidats');
        return view('back.candidates.import');
    }
}
