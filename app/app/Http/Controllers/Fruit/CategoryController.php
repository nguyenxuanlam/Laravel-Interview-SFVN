<?php

namespace App\Http\Controllers\Fruit;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index()
    {
        $fruitCategories = Category::query()->orderBy('name')->get();
        return view('shop.fruit_category',[
            'fruitCategories' => $fruitCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $input = $request->all();
        Category::create($input);
        return redirect()->route('categories');
    }
}
