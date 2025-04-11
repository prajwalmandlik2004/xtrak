<?php

namespace App\Http\Controllers;

use App\Models\Trgdashboard;

class OppMcpController extends Controller
{
    public function index()
    {
        $data = Trgdashboard::all();
        return view('back.oppmcplist.admin', compact('data'));
    }
}
