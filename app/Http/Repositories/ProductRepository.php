<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected Product $model;

    public function __construct(Product $order)
    {
        $this->model = $order;
    }

    public function getAllProducts()
    {
        return $this->model->all();
    }

    public function getProductById(int $productId): Product
    {
        return $this->model->findOrFail($productId);
    }
}
