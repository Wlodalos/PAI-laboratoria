<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        $user = DB::table('konta')
                    ->where('login', $login)
                    ->where('haslo', $password)
                    ->first();

        if ($user) {
            session(['user_rola' => $user->rola]);
            session(['user_login' => $user->login]);
            return redirect('/')->with('success', 'Zalogowano pomyślnie z bazy danych!');
        }

        return back()->with('error', 'Błędny login lub hasło.');
    }

    public function logout()
    {
        session()->forget(['user_rola', 'user_login']);
        return redirect('/')->with('success', 'Wylogowano.');
    }
}