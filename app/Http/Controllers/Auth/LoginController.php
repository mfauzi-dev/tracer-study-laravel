<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function create()
    {
        return view('pages.auth.login');
    }

    public function store(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('nomor_induk', 'password'))) {
            throw ValidationException::withMessages([
                'nomor_induk' => 'Nomor Induk dan Password anda tidak terdaftar. Mohon hubungi admin.'
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role_as === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role_as === 'alumni') {
            return redirect()->route('alumni.dashboard');
        }

        // fallback kalau role tidak dikenal
        Auth::logout();

        return redirect()->route('login');
    }
}
