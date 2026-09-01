<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mb_User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:mb_users,mb_email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = mb_User::create([
            'mb_name' => $validated['name'],
            'mb_email' => $validated['email'],
            'mb_phone' => $validated['phone'],
            'mb_password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Inscription réussie!');
    }
    public function showRegister()
    {
        return view('register');
    }
    public function showLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'mb_email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
