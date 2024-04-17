<?php

namespace App\Http\Controllers;

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController as FortifyAuthenticatedSessionController;
use Illuminate\Http\Request;
use App\Models\UserLogin; // Assurez-vous d'importer le modèle UserLogin si vous l'utilisez

class AuthenticatedSessionController extends FortifyAuthenticatedSessionController
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt($request->only('email', 'password'))) {
            $user = auth()->user();
            UserLogin::create([
                'user_id' => $user->id,
                'login_at' => now(),
            ]);
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Identifiants incorrects');
    }
}
