<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserActivityTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            $user = Auth::user();
            $user->last_seen = now();
            $user->save();
        }

        return $response;
    }
}

