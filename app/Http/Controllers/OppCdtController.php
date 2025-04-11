<?php

namespace App\Http\Controllers;

use App\Models\Trgdashboard;

class OppCdtController extends Controller
{
    public function index()
    {
        $data = Trgdashboard::all();
        return view('back.oppcdtlist.admin', compact('data'));
    }
}
