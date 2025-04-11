<?php

namespace App\Http\Controllers;

use App\Models\Trgdashboard;

class TrgCtcController extends Controller
{
    public function index()
    {
        $data = Trgdashboard::all();
        return view('back.trgctclist.admin', compact('data'));
    }
}
