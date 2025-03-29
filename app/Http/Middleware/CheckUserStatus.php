<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status != 'active') {
            Auth::logout();
            return response()->json([
                'status' => 'error',
                'message' => 'Your account is inactive.'
            ]);
        }

        return $next($request);
    }
}
