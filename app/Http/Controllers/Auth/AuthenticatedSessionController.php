<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(RouteServiceProvider::HOME);
    // }

    public function store(LoginRequest $request): RedirectResponse
{
    $credentials = $request->only('email', 'password');

    // Find the user in the admin_users table
    $user = \App\Models\AdminUser::where('email', $credentials['email'])->first();

    // Check if user exists and status is active
    if (!$user || $user->status != '1') {
        return redirect()->route('login')->withErrors(['error' => 'Your account is inactive.']);
    }

    // Attempt to authenticate the user
    if (Auth::guard('admin_users')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    return redirect()->route('login')->withErrors(['error' => 'Invalid credentials.']);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin_users')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
