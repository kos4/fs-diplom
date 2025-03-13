<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index() {
        $user = auth()->user();

        if ($user && $user->is_admin) {
            return redirect()->route('admin');
        }

        return view('admin.pages.login', [
            'pageTitle' => 'Авторизация | ' . config('app.name'),
        ]);
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin');
        }

        return back()->withErrors([
            'message' => 'Вы ввели неверный e-mail или пароль.',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
