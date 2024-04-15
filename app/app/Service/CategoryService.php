<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class CategoryService
{


    /**
     * @var $categoryRepository
     */
    protected $categoryRepository;

    /**
     * OrderService constructor
     */
    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategory()
    {
        return $this->categoryRepository->getAll();
    }

    public function saveCategoryData($data)
    {
        $this->categoryRepository->save($data);
    }
}
