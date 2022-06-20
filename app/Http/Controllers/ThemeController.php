<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $themes = Theme::all();
        return view('forum.message', compact('themes', 'categories'));
    }


    public function create()
    {
        $categories = Category::all();
        $themes = Theme::all();
        return view('forum.message', compact('themes', 'categories'));
    }


    public function store(Request $request)
    {
        Theme::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
