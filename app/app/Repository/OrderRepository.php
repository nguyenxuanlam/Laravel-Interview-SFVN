<?php

namespace App\Repository;

use App\Models\Order;

class OrderRepository
{
    protected $order;

    /**
     * Repository constructor
     * @param  Order  $order  .
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getAll()
    {
        return Order::with('orderItem.item.category')->get();
    }

    public function getById($id)
    {
        return Order::with('orderItem.item.category')->where('id', $id)->first();
    }

    public function create($collection = [])
    {
        $order = new $this->order;
        $order->customer_name = $collection['customer_name'];
        $order->save();
        return $order->id;
    }


    public function delete($id)
    {
        $order = $this->order->find($id);
        $order->delete();
    }
}
