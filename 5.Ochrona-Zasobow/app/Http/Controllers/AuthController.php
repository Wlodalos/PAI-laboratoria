<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $users = [
            'admin' => ['password' => 'admin123', 'rola' => 'menadzer'],
            'pracownik' => ['password' => 'pracownik123', 'rola' => 'pracownik'],
        ];

        $login = $request->input('login');
        $password = $request->input('password');

        if (isset($users[$login]) && $users[$login]['password'] == $password) {
            session(['user_rola' => $users[$login]['rola']]);
            session(['user_login' => $login]);
            return redirect('/')->with('success', 'Zalogowano pomyślnie!');
        }

        return back()->with('error', 'Błędny login lub hasło.');
    }

    public function logout()
    {
        session()->forget(['user_rola', 'user_login']);
        return redirect('/')->with('success', 'Wylogowano.');
    }
}