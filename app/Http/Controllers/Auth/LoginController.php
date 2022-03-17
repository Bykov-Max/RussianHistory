<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Category;
use App\Models\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        $categories = Category::all();
        $elements = Element::all();

        return view('auth.login', compact(['categories', 'elements']));
    }

    public function loginCheck(LoginRequest $request)
    {
        if (Auth::attempt($request->only(['email', 'password']), $request->get('remember') == 'on'))
        {
            $request->session()->regenerate();
            return redirect()->intended('auth.profile');
        }

        return back()->withErrors(['errorLogin' => 'Ошибка входа...']);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function profile()
    {
        $categories = Category::all();
        $elements = Element::all();

        return view('auth.profile', compact(['categories', 'elements']));
    }
}
