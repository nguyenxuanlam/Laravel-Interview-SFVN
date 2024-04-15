<?php

namespace App\Service;


use App\Repository\ItemRepository;


class ItemService
{


    /**
     * @var $itemRepository
     */
    protected $itemRepository;

    /**
     * OrderService constructor
     */
    public function __construct(
        ItemRepository $itemRepository
    ) {
        $this->itemRepository = $itemRepository;
    }

    public function getAllItem()
    {
        return $this->itemRepository->getAll();
    }

    public function getAllWithRelation($relation)
    {
        return $this->itemRepository->getAllWith($relation);
    }

    public function saveItemData($data)
    {
        $this->itemRepository->save($data);
    }
}
