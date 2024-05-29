<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        // dd(Uuid::uuid6()->toString());
        // dd(Hash::make('12345'));
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $username = $request->username;
        $password = $request->password;

        $request->authenticate($username, $password);
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
