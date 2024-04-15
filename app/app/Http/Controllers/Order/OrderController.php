<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Service\ItemService;
use App\Service\OrderService;

class OrderController extends Controller
{
    public $orderService;
    public $itemService;

    public function __construct(OrderService $orderService, ItemService $itemService)
    {
        $this->orderService = $orderService;
        $this->itemService = $itemService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->orderService->getAllOrder();
        return view('shop.orders', ['orders' => $orders]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = $this->itemService->getAllItem();
        return view('shop.order_add', ['items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {

        $input = $request->all();
        $orderId = $this->orderService->saveOrder($input);
        $this->orderService->saveOrderItem($orderId, $input);
        return redirect('order');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order = $this->orderService->getOrderById($order->id);
        $items = $this->itemService->getAllItem();
        return view('shop.order_edit', [
            'items' => $items,
            'order' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        $input = $request->all();
        $this->orderService->createOrUpdateOrderItem($order, $input);
        return redirect('order');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $this->orderService->deleteOrder($order->id);
        return redirect('order');
    }
}
