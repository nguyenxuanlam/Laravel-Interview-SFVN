<?php

namespace App\Http\Controllers\Fruit;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Service\CategoryService;
use App\Service\ItemService;

class ItemController extends Controller
{

    public $itemService;
    public $categoryService;

    public function __construct(ItemService $itemService, CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->itemService = $itemService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fruits = $this->itemService->getAllWithRelation('category');
        $fruitCategories = $this->categoryService->getAllCategory();
        return view('shop.fruit_item', [
            'fruits' => $fruits,
            'fruitCategories' => $fruitCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $input = $request->all();
        $this->itemService->saveItemData($input);
        return redirect()->route('item');
    }

}
