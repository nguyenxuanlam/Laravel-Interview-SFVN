<?php

namespace App\Service;

use App\Models\Order;
use App\Repository\ItemRepository;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;

class OrderService
{
    /**
     * @var $orderRepository
     */
    protected $orderRepository;

    /**
     * @var $orderItemRepository
     */
    protected $orderItemRepository;

    /**
     * @var $itemRepository
     */
    protected $itemRepository;

    /**
     * OrderService constructor
     */
    public function __construct(
        OrderRepository $orderRepository,
        OrderItemRepository $orderItemRepository,
        ItemRepository $itemRepository,
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->itemRepository = $itemRepository;
    }

    //order
    public function saveOrder($data)
    {
        return $this->orderRepository->create($data);
    }

    public function saveOrderItem($orderId, $data)
    {
        $orderData = $this->formatData($data);
        $this->orderItemRepository->save($orderId, $orderData);
    }

    public function createOrUpdateOrderItem(Order $order, $data)
    {
        $orderData = $this->formatData($data);
        $orderId = $order->id;
        $orderItems = $order->orderItem()->get();
        foreach ($orderData as $data) {
            foreach ($orderItems as $orderItem) {
                $data['order_id'] = $orderId;
                $this->orderItemRepository->saveOrUpdate($orderId, $orderItem, $data);
            }
        }
    }

    public function getAllOrder()
    {
        return $this->orderRepository->getAll();
    }

    public function getOrderById($orderId)
    {
        return $this->orderRepository->getById($orderId);
    }

    public function deleteOrder($orderId)
    {
        $this->orderRepository->delete($orderId);
    }

    public function formatData($oderDetail)
    {
        $data = [];
        $temp = [];
        $results = [];
        if (is_array($oderDetail['item_id'])) {
            foreach ($oderDetail['item_id'] as $key => $value) {
                $data[] = [
                    'item_id' => $value,
                    'quantity' => $oderDetail['quantity'][$key]
                ];
            }
        } else {
            foreach ($oderDetail['quantity'] as $quantity) {
                $data[] = [
                    'item_id' => $oderDetail['item_id'],
                    'quantity' => $quantity
                ];

            }
        }

        //remove duplicate
        foreach ($data as $item) {
            if (in_array($item['item_id'], $temp)) {
                foreach ($results as &$result) {
                    if ($result['item_id'] == $item['item_id']) {
                        $result['quantity'] += $item['quantity'];
                    }
                }
            } else {
                $temp[] = $item['item_id'];
                $results[] = $item;
            }
        }
        return $results;
    }
}
