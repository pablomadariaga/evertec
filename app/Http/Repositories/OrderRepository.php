<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{

    public function getAllOrders()
    {
        return Order::all();
    }

    public function getOrderById(int $orderId): Order
    {
        return Order::findOrFail($orderId);
    }

    public function createOrder(array $orderDetails): Order
    {
        $order = Order::create($orderDetails);
        $order->orderDetails()->create([
            'product_id' => $orderDetails['product_id'],
        ]);

        return $order;
    }

    public function updateOrder(int $orderId, array $newDetails): Order
    {
        $order = Order::find($orderId);
        $order->update($newDetails);
        return $order;
    }

    public function getAllOrdersByOrderState(int $orderStateId)
    {
        return Order::getAllByOrderState($orderStateId)->get();
    }
}
