<?php

namespace App\Http\Controllers\Api;

use App\Http\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProductApiController extends BaseApiController
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
    )
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse($this->productRepository->getAllProducts());
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->successResponse($this->productRepository->getProductById($id));
    }

}
