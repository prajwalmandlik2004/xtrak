<?php

namespace App\Http\Controllers;

use App\Models\Trgdashboard;

class CdtMcpController extends Controller
{
    public function index()
    {
        $data = Trgdashboard::all();
        return view('back.cdtmcplist.admin', compact('data'));
    }
}



