<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{

    protected Order $model;

    public function __construct(Order $order) {
        $this->model = $order;
    }

    public function getAllOrders()
    {
        return $this->model->all();
    }

    public function getOrderById(int $orderId): Order
    {
        return $this->model->findOrFail($orderId);
    }

    public function createOrder(array $orderDetails): Order
    {
        $order = $this->model->create($orderDetails);
        $order->orderDetails()->create([
            'product_id' => $orderDetails['product_id'],
        ]);

        return $order;
    }

    public function updateOrder(int $orderId, array $newDetails): Order
    {
        $order = $this->model->find($orderId);
        $order->update($newDetails);
        return $order;
    }

    public function getAllOrdersByOrderState(int $orderStateId)
    {
        return $this->model->getAllByOrderState($orderStateId);
    }
}
