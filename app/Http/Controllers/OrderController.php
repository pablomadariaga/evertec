<?php

namespace App\Http\Controllers;

use App\Enums\OrderStateEnum;
use App\Http\Interfaces\CustomerRepositoryInterface;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Interfaces\ProductRepositoryInterface;
use App\Http\Requests\OrderCreateRequest;
use App\Http\Traits\PlaceToPay;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
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
     * Display a listing of the order.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.index');
    }

    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  App\Http\Requests\OrderCreateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrderCreateRequest $request): RedirectResponse
    {
        $customerDetails = $request->validated();
        $customer = $this->customerRepository->updateOrCreateCustomer($customerDetails);
        $product = $this->productRepository->getProductById($request->input('product'));
        $order = $this->orderRepository->createOrder([
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'total' => $product->getRawOriginal('price'),
            'reference' => randomString(15,false,true)
        ]);
        return redirect()->route('order.show',['order'=>$order->id]);
    }

    /**
     * Display the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('order.summary',[
            'order' => $this->orderRepository->getOrderById($id)
        ]);
    }

    /**
     * Display the specified order payment result.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paymentResult($id)
    {
        $order = $this->orderRepository->getOrderById($id);
        $requestInformation = $this->getSessionPtp($order);
        $orderStatus = array_column(OrderStateEnum::cases(), null, 'name');
        $newOrderStatus = $orderStatus[capitalize($requestInformation->status->status)]->value ?? 1;
        if ($newOrderStatus!=$order->order_state_id->value) {
            $this->orderRepository->updateOrder($id,[
                'order_state_id' =>  $newOrderStatus
            ]);
        }
        return view('order.summary',[
            'order' => $order
        ]);
    }
}
