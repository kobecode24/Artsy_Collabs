<?php

namespace App\Http\Middleware;

use App\Models\JoinRequest;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class HasProject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        $user = Auth::user();

        $hasProject = $user->projects()->exists();

        if ($hasProject) {
            return $next($request);
        } else {
            return redirect()->route('login')->with('error', 'You do not have a project yet.');
        }


    }
}
