<?php

namespace App\Http\Controllers\Api;

use App\Http\Interfaces\CustomerRepositoryInterface;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Interfaces\ProductRepositoryInterface;
use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Traits\PlaceToPay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderApiController extends BaseApiController
{
    use PlaceToPay;

    private OrderRepositoryInterface $orderRepository;
    private CustomerRepositoryInterface $customerRepository;
    private ProductRepositoryInterface $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        CustomerRepositoryInterface $customerRepository,
        ProductRepositoryInterface $productRepository,
    )
    {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse($this->orderRepository->getAllOrders());
    }

    /**
     * Get the checkout url and update the request Id
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCheckout(Request $request): JsonResponse
    {
        $order = $this->orderRepository->getOrderById($request->input('id'));
        $response = $this->createSessionPtp($order);
        if ($response->status->status=="OK") {
            $this->orderRepository->updateOrder($request->input('id'),[
                'request_id' => $response->requestId,
                'process_url' => $response->processUrl
            ]);
            return $this->successResponse($response,
                Response::HTTP_CREATED,
                $response->status->message
            );
        }

        return $this->errorResponse();

    }

    /**
     * Display the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->successResponse($this->orderRepository->getOrderById($id));
    }

    /**
     * Update the specified order in storage.
     *
     * @param  App\Http\Requests\OrderUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OrderUpdateRequest $request, int $id): JsonResponse
    {
        // Retrieve the validated input data...
        $orderDetails = $request->validated();
        return response()->json([
            'data' => $this->orderRepository->updateOrder($id, $orderDetails)
        ]);
    }
}
