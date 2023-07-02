<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function signupForm(){
        return view('auth.signup');
    }
    public function signup(Request $request){
        $user = $request->validate(
            [
                "name" => ['required', 'min:8', 'string', 'max:255'],
                "email" => ['required','email', 'max:255', 'unique:users,email'],
                "password" => ['required', 'string', 'min:8', 'max:30', 'confirmed']
            ]
        );
        $usercreate = User::create([
            "name" => $user['name'],
            "email" => $user['email'],
            "password" => bcrypt($user['password'])
        ]);
        return redirect()->route('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            // return redirect()->route('home.client');
            if (auth()->user()->isAdmin()) {
                return redirect()->route('home.admin');
            } else {
                return redirect()->route('home.client');
            }
        } else {
            return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials']);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
