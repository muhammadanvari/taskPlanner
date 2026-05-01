<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required',
            'password' => 'required|string',
        ]);
        if (auth()->attempt($credentials , $request->remember)) {
            $request->session()->regenerate();
            auth()->user()->update([
                'last_activity' => \Illuminate\Support\now(),
            ]);
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'phone' => 'اطلاعات وارد شده صحیح نمیباشد.',
        ]);
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string',
//            'email' => 'string|email|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string',
        ]);
        User::create([
            'name' => $credentials['name'],
//            'email' => $credentials['email'],
            'phone' => $credentials['phone'],
            'password' => Hash::make($credentials['password']),
        ]);
        return redirect()->intended('/login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->intended('/');
    }
}
