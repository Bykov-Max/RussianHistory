<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Category;
use App\Models\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    public function login()
    {
        $categories = Category::all();
        $elements = Element::all();

        return view('admin.login', ['elements' => $elements ,'categories' => $categories]);
    }

    public function loginCheck(LoginRequest $request)
    {
        $categories = Category::all();
        $elements = Element::all();

        if (Auth::attempt($request->only(['email', 'password'])) && Gate::allows('admin')) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard', ['elements' => $elements ,'categories' => $categories]);
        }

        return back()->withErrors(['errorLogin' => 'Ошибка входа...']);
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function dashboard(){
        $categories = Category::all();
        $elements = Element::all();

        return view('admin.dashboard', ['elements' => $elements ,'categories' => $categories]);
    }
}
