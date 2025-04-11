<?php

namespace App\Http\Controllers;

use App\Models\Trgdashboard;

class CstOppController extends Controller
{
    public function index()
    {
        $data = Trgdashboard::all();
        return view('back.cstopplist.admin', compact('data'));
    }
}
