<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProductById(int $ProductId): Product
    {
        return Product::findOrFail($ProductId);
    }
}
