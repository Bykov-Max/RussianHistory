<?php

namespace App\Http\Controllers;

use App\Http\Resources\ElementResource;
use App\Models\Category;
use App\Models\Element;
use App\Models\Image;
use App\Services\FileServices;
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
        if (Auth::check()) {
            $categories = Category::all();
            $elements = Element::with(['category']);

            return view('elements.create', compact('categories', 'elements'));
        }
    }

    public function store(Request $request)
    {
        $path = FileServices::uploadFile($request->file('image'));
        $path2 = FileServices::uploadFile($request->file('back_img'));

        if (Gate::allows('admin')) {
            $element = Element::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'back_img' => $path2,
            ]);

            $element->images::create([
                'image' => $path
            ]);
        }

        return redirect('elements.index');
    }

    public function show(Element $element)
    {
        //
    }

    public function edit(Element $element)
    {
        if (Gate::allows('edit-element')) {
            return view('elements.edit', ['element' => $element]);
        }
    }

    public function update(Element $element)
    {
        if (Gate::allows('admin')) {
            FileServices::updateFile($element->images);
            $element->update();
            return redirect()->route('elements.index');
        }

        return redirect()->route('elements.edit', ['element' => $element])->with('success', 'Данные успешно обновлены');
    }

    public function destroy(Element $element)
    {
        if (Gate::allows('delete-element', $element)) {
            FileServices::deleteFile($element->image);
            $element->delete();
            return redirect()->route('elements.index');
        }

        return redirect()->route('elements.index', ['element' => $element])->with('success', 'Данные успешно удалены');
    }

    public function allElements()
    {
        if (Gate::allows('admin')) {
            return ElementResource::collection(Element::all());
        }
        return abort(403, 'Только для администратора');
    }

    public function filterCategory(Category $category)
    {
        $elements = ElementResource::collection($category->elements);

        return compact('elements');
    }

    public function filter(Category $category)
    {
        return view('elements.show', [
            'categories' => Category::all(),
            'category' => $category,
            'elements' => $category->elements
        ]);
    }

    public function oneElement(Element $element)
    {
        return view('elements.oneElement', [
            'categories' => Category::all(),
            'element' => $element
        ]);
    }

    public function showElements()
    {
        $categories = Category::all();
        $elements = Element::with(['category']);

        return view('elements.index', compact('categories', 'elements'));
    }
}
