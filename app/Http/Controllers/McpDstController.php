<?php

namespace App\Http\Controllers;

use App\Models\Trgdashboard;

class McpDstController extends Controller
{
    public function index()
    {
        $data = Trgdashboard::all();
        return view('back.mcpdstlist.admin', compact('data'));
    }
}
