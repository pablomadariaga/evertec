<x-app-layout>
    <x-slot name="header">
        {{ __('Order') }} #{{$order->id}}
    </x-slot>
    <section x-data="productsData" class="child-transition-color">
        <div
            class="grid grid-cols-1 text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-1000 p-5 md:px-8 md:pb-8 rounded-md shadow">
            <div class="md:pr-5">
                <div class="flex">
                    <h2 class="text-lg md:text-xl mr-auto">{{ __('Order Summary') }}</h2>
                    <x-order-badge :order="$order"/>
                </div>
                <div
                    class="py-7 mt-5 px-5 border-2 rounded-md shadow-lg dark:bg-slate-900 dark:bg-opacity-20 dark:border-slate-900 text-sm">
                    <div>
                        <div>
                            <div class="flex flex-wrap justify-between">
                                <span class="font-semibold mr-auto">{{__('Reference')}}:</span>
                                <span>{{ $order->reference; }}</span>
                            </div>
                            <div class="flex flex-wrap items-center mt-2 justify-between">
                                <span class="font-semibold mr-auto">{{__('Request Id')}}:</span>
                                <span>{{ $order->request_id ?? 'N/A'}}</span>
                            </div>
                            <div class="flex flex-wrap items-center mt-2 justify-between">
                                <span class="font-semibold mr-auto">{{__('Customer')}}:</span>
                                <span class="truncate" x-tooltip.raw="{{ $order->customer->first_name.' '.$order->customer->last_name}}">
                                    {{ $order->customer->first_name.' '.$order->customer->last_name}}
                                </span>
                            </div>
                            <div class="flex flex-wrap items-center mt-2 justify-between">
                                <span class="font-semibold mr-auto">{{__('Email')}}:</span>
                                <span class="truncate" x-tooltip.raw="{{ $order->customer->email}}">
                                    {{ $order->customer->email}}
                                </span>
                            </div>
                            <div class="flex flex-wrap items-center mt-2 justify-between">
                                <span class="font-semibold mr-auto">{{__('Mobile')}}:</span>
                                <span class="truncate" x-tooltip.raw="{{ $order->customer->mobile}}">
                                    {{ $order->customer->mobile}}
                                </span>
                            </div>
                            <div class="flex flex-wrap items-center mt-2 justify-between">
                                <span class="font-semibold mr-auto">{{__('Shipping information')}}:</span>
                                <span class="truncate" x-tooltip.raw="{{ $order->customer->address}}">
                                    {{ $order->customer->address}}
                                </span>
                            </div>
                            @if (!$order->request_id)
                                <div class="flex flex-wrap items-center mt-2 justify-between" x-data="orderProcess({{$order->id}})">
                                    <x-button class="w-full" @click="getCheckout">
                                        {{__('Pay')}} <x-icon.arrow-uturn-right class="w-4"/>
                                    </x-button>
                                </div>
                            @endif
                            @if ($order->request_id&&$order->order_state_id->value == 3)
                                <div>
                                    <form id="create-order-form" method="POST" action="{{ route('order.store') }}" autocomplete="off" class="flex flex-wrap items-center mt-2 justify-between">
                                        @csrf
                                        <input type="hidden" name="address" value="{{$order->customer->address}}">
                                        <input type="hidden" name="first_name" value="{{$order->customer->first_name}}">
                                        <input type="hidden" name="last_name" value="{{$order->customer->last_name}}">
                                        <input type="hidden" name="email" value="{{$order->customer->email}}">
                                        <input type="hidden" name="mobile" value="{{$order->customer->mobile}}">
                                        <input type="hidden" name="product" value="{{$order->orderDetails[0]->product->id}}">
                                        <x-button type="submit" class="w-full">
                                            {{__('Reorder')}} <x-icon.arrow-uturn-right class="w-4"/>
                                        </x-button>
                                    </form>
                                </div>
                            @endif
                            @if ($order->request_id&&$order->order_state_id->value == 4)
                                <div class="flex flex-wrap items-center mt-2 justify-between">
                                    <x-button :link="true" href="{{$order->process_url}}" class="w-full">
                                        {{__('Retry payment')}} <x-icon.arrow-uturn-right class="w-4"/>
                                    </x-button>
                                </div>
                            @endif
                        </div>
                        <div>
                            @foreach ($order->orderDetails as $detail)
                            <div class="border-t-2 dark:border-slate-900 pt-3 mt-4">
                                <div class="mt-2">
                                    <div class="flex flex-wrap items-center justify-between font-semibold">
                                        <span class="mr-auto">{{__('Product')}}:</span>
                                        <span class="text-evertec-400 dark:text-evertec-200">
                                            {{$detail->product->name}}
                                        </span>
                                        <div class="mx-auto w-full border-t-2 mt-2 border-dashed opacity-75 border-slate-50 dark:border-slate-900"></div>
                                    </div>
                                    <div class="flex flex-wrap items-center text-center pt-4 justify-between">
                                        <p class="w-full">{{$detail->product->description}}</p>
                                        <div class="mx-auto w-full border-t-2 mt-4 border-dashed opacity-75 border-slate-50 dark:border-slate-900"></div>
                                    </div>
                                    <div class="flex flex-wrap items-center mt-2 justify-between">
                                        <span class="font-semibold mr-auto">{{__('Quantity')}}:</span>
                                        <span>1</span>
                                        <div class="mx-auto w-full border-t-2 mt-2 border-dashed opacity-75 border-slate-50 dark:border-slate-900"></div>
                                    </div>
                                    <div class="flex flex-wrap items-center mt-2 justify-between">
                                        <span class="font-semibold mr-auto">{{__('Price')}}:</span>
                                        <span>
                                            {{$detail->product->price}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="border-t-2 dark:border-slate-900 py-3 mt-4">
                            <div class="flex flex-wrap justify-between">
                                <span class="font-semibold mr-auto">{{__('Total')}}:</span>
                                <span x-text="`$${currentProduct.price}`"></span>
                            </div>
                            <div class="flex flex-wrap items-center mt-2 justify-between">
                                <span class="font-semibold mr-auto">{{__('Transport')}}:</span>
                                <span>{{__('Free')}}</span>
                            </div>
                        </div>
                        <div class="border-t-2 dark:border-slate-900 py-3">
                            <div class="flex items-center">
                                <div class="pr-3">
                                    <x-icon.shield-check />
                                </div>
                                <div class="text-justify">
                                    <p class="font-semibold dark:text-slate-50 text-slate-900">
                                        {{__('Security policy')}}:
                                    </p>
                                    <p>{{__('Security and trust for the client, we treat the data privately')}}</p>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <div class="pr-3">
                                    <x-icon.archive-box />
                                </div>
                                <div class="text-justify">
                                    <p class="font-semibold dark:text-slate-50 text-slate-900">
                                        {{__('Delivery policy')}}:
                                    </p>
                                    <p>
                                        {{__('The delivery of the products has a maximum time available of 5 working days')}}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <div class="pr-3">
                                    <x-icon.archive-box-x-mark />
                                </div>
                                <div class="text-justify">
                                    <p class="font-semibold dark:text-slate-50 text-slate-900">
                                        {{__('Return policy')}}:
                                    </p>
                                    <p>
                                        {{__('The product warranty is effective when it has manufacturing defects.')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
