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
        return view('back.candidates.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.candidates.create');
    }
    public function import()
    {
        return view('back.candidates.import');
    }

    
}
