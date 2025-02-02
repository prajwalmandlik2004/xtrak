<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;

class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('Menu accès BaseCDT');
        return view('back.opportunity.index');
    }

    public function state($state)
    {
        $this->authorize('Menu etats');
        return view('back.opportunity.state', ['state' => $state]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('Menu saisie');
        return view('back.opportunity.form', [
            'action' => 'create',
            'candidate' => new Candidate(),
        ]);
    }
    public function edit(Candidate $candidate)
    {
        
        return view('back.opportunity.form', [
            'action' => 'update',
            'candidate' => $candidate,
        ]);
    }
    public function show(Candidate $candidate)
    {
        // $this->authorize('Voir un candidat');
        return view('back.opportunity.show', [
            'candidate' => $candidate,
        ]);
    }

    public function management()
    {
        return view('back.opportunity.management');
    }

    public function evts()
    {
        return view('back.opportunity.evts');
    }

    public function import()
    {
        $this->authorize('Importer des candidats');
        return view('back.opportunity.import');
    }
    public function candidateCv(Candidate $candidate)
    {
        return view('back.opportunity.cv', [
            'candidate' => $candidate,
        ]);
    }
    public function showFile(Candidate $candidate)
{
    $files = File::all();
    return view('livewire.back.files.candidate-file', ['candidate' => $candidate]);}

}
