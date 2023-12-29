<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class authController extends Controller
{
    public function loginview()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }

    public function registerView()
    {

        return view('auth.register');
    }
     public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|min:5|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'min:6||same:confirm-password',
            'confirm-password' => 'required| min:4'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

        return redirect()->route('login')->with('success', 'User created successfully.');   
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }   
}
