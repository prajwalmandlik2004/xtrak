<?php

namespace App\Http\Controllers;

use App\Models\Trgdashboard;

class TrgMcpController extends Controller
{
    public function index()
    {
        $data = Trgdashboard::all();
        return view('back.trgmcplist.admin', compact('data'));
    }
}
