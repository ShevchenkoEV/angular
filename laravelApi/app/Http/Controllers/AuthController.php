<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('front.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        session()->flash('success', 'Регистрация пройдена!');

        Auth::login($user);
        return redirect()->route('home');
    }

    public function loginForm()
    {
        return view('front.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            session()->flash('success', 'Вы успешно авторизованы!!!');
            if (Auth::user()->is_admin) {
                return redirect()->route('main.page');
            } else {
                return redirect()->route('home');
            }
        }
        return redirect()->back()->with('error', 'Не вырный логин или пароль!!!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
