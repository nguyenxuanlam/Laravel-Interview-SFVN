<?php

namespace App\Http\Controllers\Fruit;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Service\CategoryService;

class CategoryController extends Controller
{
    public $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /*
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index()
    {
        $fruitCategories = $this->categoryService->getAllCategory();
        return view('shop.fruit_category', [
            'fruitCategories' => $fruitCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $input = $request->all();
        $this->categoryService->saveCategoryData($input);
        return redirect()->route('categories');
    }
}
