<?php

namespace App\Http\Controllers;

use App\Http\Resources\ElementResource;
use App\Models\Category;
use App\Models\Element;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ElementController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $elements = Element::with(['category']);
        $images = Image::with(['element']);

        return view('elements.show', compact('categories', 'elements', 'images'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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

    public function allElements(){
        if(Gate::allows('admin')){
            return ElementResource::collection(Element::all());
        }
        return abort(403, 'Только для администратора');
    }

    public function filterCategory(Category $category){
        $elements = ElementResource::collection($category->elements);

        return compact('elements');
    }

    public function filter(Category $category){
        return view('elements.show', [
            'categories' => Category::all(),
            'category' => $category,
            'elements' => $category->elements
        ]);
    }

    public function oneElement(Element $element){
        return view('elements.oneElement', [
            'categories' => Category::all(),
            'element' => $element
        ]);
    }

    public function showElements(){
        $categories = Category::all();
        $elements = Element::with(['category']);

        return view('elements.index', compact('categories', 'elements'));
    }
}
