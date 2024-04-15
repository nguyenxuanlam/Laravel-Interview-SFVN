<?php

namespace App\Repository;

use App\Models\Item;

class ItemRepository
{
    protected $item;

    /**
     * Repository constructor
     * @param  Item  $item  .
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function getAll()
    {
        return Item::all();
    }

    public function getAllWith($relations)
    {
        return Item::with($relations)->orderBy('name')->get();
    }

    public function save($data)
    {
        $item = new $this->item;
        $item->name = $data['name'];
        $item->price = $data['price'];
        $item->unit = $data['unit'];
        $item->category_id = $data['category_id'];
        $item->save();
    }

}
