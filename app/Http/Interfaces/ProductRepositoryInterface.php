<?php

namespace App\Http\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{
    /**
     * Get all store products
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product>
     */
    public function getAllProducts();

    /**
     * Get a store product by id
     *
     * @param integer $productId
     * @return Product
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException<\Illuminate\Database\Eloquent\Model>
     */
    public function getProductById(int $productId): Product;

}
