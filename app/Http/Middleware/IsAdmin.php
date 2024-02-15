<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {

        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            return redirect()->route('user.projects.list')->with('error', 'You do not have permission to access this area.');
        }

        return $next($request);
    }
}
