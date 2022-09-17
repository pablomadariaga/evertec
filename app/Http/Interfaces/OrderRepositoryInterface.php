<?php

namespace App\Http\Interfaces;

use App\Models\Order;

interface OrderRepositoryInterface
{
    /**
     * Get all store orders
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order>
     */
    public function getAllOrders();

    /**
     * Get a store order by id
     *
     * @param integer $orderId
     * @return Order
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException<\Illuminate\Database\Eloquent\Model>
     */
    public function getOrderById(int $orderId): Order;


    /**
     * Save a new order and return the instance.
     *
     * @param array $orderDetails
     * @return Order
     */
    public function createOrder(array $orderDetails): Order;

    /**
     * Save a new order and return the instance.
     *
     * @param integer $orderId
     * @param array $newDetails
     * @return Order
     */
    public function updateOrder(int $orderId, array $newDetails): Order;

    /**
     * Get all store orders by order state
     *
     * @param int $orderStateId
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order>
     */
    public function getAllOrdersByOrderState(int $orderStateId);
}
