<?php

namespace App\Http\Controllers;

use App\Models\Oppdashboard;

class OpplistController extends Controller
{
    public function index()
    {

        $data = Oppdashboard::all();
        return view('back.opplist.admin', compact('data'));
    }
}


