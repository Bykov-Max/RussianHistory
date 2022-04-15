<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreElementrequest;
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
        $elements = Element::with(['category']);
        $images = Image::with(['element']);

        return view('elements.show', compact( 'elements', 'images'));
    }

    public function create()
    {
        if (Gate::allows('admin')) {
            $categories = Category::all();

            return view('elements.create', compact('categories'));
        }
    }

    public function store(Request $request)
    {
        $path = FileServices::uploadFile($request->file('image'));
        $path2 = FileServices::uploadFile($request->file('back_image'));

        if (Gate::allows('admin')) {
            $category = Category::find($request->input('category_id'));
            $element = $category->elements()->create([
                'name' => $request->name,
                'description' => $request->input('description'),
                'back_img' => $path2,
            ]);

            $element->images()->create([
                'image' => $path
            ]);


            $categories = Category::all();
            return view('elements.create', compact('categories'));
        }
    }

    public function show(Element $element)
    {
        //
    }

    public function edit(Element $element)
    {
        if (Gate::allows('edit-element') && Gate::allows('admin')) {
            $categories = Category::all();

            return view('elements.edit', compact('categories', 'element'));
        }
    }

    public function update(StoreElementrequest $request,Element $element)
    {
        if (Gate::allows('admin')) {
            $path = FileServices::updateFile($request->file('image'), $element->back_img);

            foreach ($element->images as $image){
                FileServices::updateFile($request->file('image'), $image);
            }

            $element->update([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'image' => $path,
                'category_id' => $request->get('category_id'),
            ]);

            return redirect()->route('admin.show.elements', ['element' => $element])->with('success', 'Данные успешно обновлены');
        }
    }

    public function destroy(Element $element)
    {
        if (Gate::allows('delete-element', $element)) {
            foreach ($element->images as $image){
                FileServices::deleteFile($image->image);
            }

            FileServices::deleteFile($element->back_img);
            $element->delete();
            return redirect()->route('admin.show.elements');
        }

        return redirect()->route('admin.show.elements', ['element' => $element])->with('success', 'Данные успешно удалены');
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
        foreach ($category->elements as $element){
            if($element->id == 1){
                $categories = Category::all();
                return view('elements.oneElement', compact('categories', 'element'));
            }
            return view('elements.show', [
                'categories' => Category::all(),
                'category' => $category,
                'elements' => $category->elements
            ]);
        }

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
