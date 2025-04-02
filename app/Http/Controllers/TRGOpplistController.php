<?php

namespace App\Http\Controllers;

use App\Models\Oppdashboard;

class TRGOpplistController extends Controller
{
    public function index()
    {

        $data = Oppdashboard::all();
        return view('back.trgopplist.admin', compact('data'));
    }
}


