<?php

namespace App\Repository;

use App\Models\OrderItem;

class OrderItemRepository
{
    protected $orderItem;

    /**
     * Repository constructor
     * @param  OrderItem  $orderItem  .
     */
    public function __construct(OrderItem $orderItem)
    {
        $this->orderItem = $orderItem;
    }

    public function getAll()
    {
        return OrderItem::all();
    }

    public function save($orderId, $collections)
    {
        foreach ($collections as $collection) {
            $orderItem = new $this->orderItem;
            $orderItem->order_id = $orderId;
            $orderItem->item_id = $collection['item_id'];
            $orderItem->quantity = $collection['quantity'];
            $orderItem->save();
        }
    }

    public function saveOrUpdate($orderId, OrderItem $orderItem, $collection)
    {
        if ($orderItem->item_id == $collection['item_id']) {
            $orderItem->update($collection);
        } else {
            $this->save($orderId, [$collection]);
        }
    }
}
