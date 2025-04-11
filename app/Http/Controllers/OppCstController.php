<?php

namespace App\Http\Controllers;

use App\Models\Trgdashboard;

class OppCstController extends Controller
{
    public function index()
    {
        $data = Trgdashboard::all();
        return view('back.oppcstlist.admin', compact('data'));
    }
}
