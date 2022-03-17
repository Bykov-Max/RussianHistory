<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Element;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        $elements = Element::all();

        return view("index", compact(['categories', 'elements']));
    }
}
