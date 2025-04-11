<?php

namespace App\Http\Controllers;

use App\Models\Trgdashboard;

class CtcMcpController extends Controller
{
    public function index()
    {
        $data = Trgdashboard::all();
        return view('back.ctcmcplist.admin', compact('data'));
    }
}
