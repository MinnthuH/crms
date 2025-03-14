<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin_users')->user(); // Using 'admin_users' guard

        if (!$user || $user->status != '1') {
            return redirect()->route('login')->with('error', 'Access denied.');
        }

        // Allow role=0 only for the dashboard route
        if ($user->role == '0' && !$request->is('/')) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
