<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Category;
use App\Models\Element;
use App\Models\User;
use App\Services\FileServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(){
        $categories = Category::all();
        $elements = Element::all();

        return view('auth.register', compact(['categories', 'elements']));
    }

    public function registerStore(RegisterRequest $request){
        if(Auth::attempt($request->only(['email', 'password']))){
            return back()->withErrors(['errorRegister' => 'Пользователь с такими данными уже есть...']);
        }

        $user = User::create([
            'password' => Hash::make($request->password),
            'photo' => FileServices::uploadFile($request->file('image')),
        ]+ $request->only(['email', 'name', 'surname']));

        if($user){
            Auth::login($user);
            return redirect()->route('home');
        }

        return back()->withErrors([
            'errorRegister' => 'что-то пошло не так...'
        ]);
    }
}
