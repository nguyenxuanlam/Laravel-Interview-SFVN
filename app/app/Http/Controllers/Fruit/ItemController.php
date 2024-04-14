<?php

namespace App\Http\Controllers\Fruit;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fruits =  Item::with('category')->orderBy('name')->get();
        $fruitCategories = Category::query()->orderBy('name')->get();
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
        Item::create($input);
        return redirect()->route('item');
    }

}
