<?php

namespace App\Repository;

use App\Models\Category;


class CategoryRepository
{
    protected $category;

    /**
     * Repository constructor
     * @param  Category  $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return Category::all();
    }

    public function save($data)
    {
        $category = new $this->category;
        $category->name = $data['name'];
        $category->save();
    }
}
