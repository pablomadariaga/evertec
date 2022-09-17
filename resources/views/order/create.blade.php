<x-app-layout>
    <x-slot name="header">
        {{ __('Comprar') }}
    </x-slot>
    <section x-data="productsData" class="child-transition-color">
        <div class="grid grid-cols-1 gap-3 text-slate-600 dark:text-slate-300 md:grid-cols-3 md:gap-8 bg-white dark:bg-slate-1000 p-5 md:px-8 md:pb-8 rounded-md shadow">
            <div class="md:col-span-2 md:pr-5">
                <h2 class="text-lg md:text-xl">{{ __('Shipping information') }}</h2>
                <form id="create-order-form" method="POST" action="{{ route('order.store') }}" autocomplete="off">
                    @csrf
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 items-center">
                        <x-input label="{{__('Address')}}" wrapperClass="md:col-span-2" id="address" name="address"
                            value="{{old('address')}}" maxlength="255" />
                    </div>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 items-center">
                        <x-input label="{{__('First name')}}" wrapperClass="md:col-span-2" id="first_name" name="first_name"
                            value="{{old('first_name')}}" maxlength="40" />
                    </div>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 items-center">
                        <x-input label="{{__('Last name')}}" wrapperClass="md:col-span-2" id="last_name" name="last_name"
                            value="{{old('last_name')}}" maxlength="40" />
                    </div>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 items-center">
                        <x-input type="email" label="{{__('Email')}}" only="email" wrapperClass="md:col-span-2" id="email"
                            name="email" value="{{old('email')}}" maxlength="255" />
                    </div>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 items-center">
                        <x-input type="tel" label="{{__('Mobile')}}" only="digits" wrapperClass="md:col-span-2" id="mobile"
                            name="mobile" value="{{old('mobile')}}" maxlength="25" />
                    </div>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 items-center">
                        <x-select label="{{__('Product')}}" wrapperClass="md:col-span-2" id="product" name="product"
                            x-data="select('product')" x-model="queryParam">
                            <option value="" selected>{{__('Select an option')}}</option>
                            <template x-for="product in products" :key="product.id">
                                <option x-bind:value="product.id" x-bind:selected="product.id==queryParam"
                                    x-text="product.name"></option>
                            </template>
                        </x-select>
                    </div>
                    <div class="w-full flex">
                        <x-button type="submit" label="{{__('Make an order')}}" class="mt-8 ml-auto" />
                    </div>
                </form>
            </div>
            <div
                class="py-7 mt-5 md:mt-0 px-5 border-2 rounded-md shadow-lg dark:bg-slate-900 dark:bg-opacity-20 dark:border-slate-900 text-sm">
                <p>1 {{__('Product')}}</p>
                <div class="text-xs">
                    <div x-data="{ expanded: false}" class="mt-2">
                        <x-button label="{{__('See details')}}" size="xs" @click="expanded = ! expanded" />
                        <div class="mt-4" x-show="expanded" x-collapse>
                            <p class="text-evertec-400 dark:text-evertec-200 font-semibold"
                                x-text="currentProduct.name" />
                            <p class="">x1</p>
                            <div class=" flex flex-wrap justify-between">
                                <span class="font-semibold">{{__('Price')}}:</span>
                                <span x-text="`$${currentProduct.price}`"></span>
                            </div>
                        </div>
                    </div>
                    <div class="border-t-2 dark:border-slate-900 py-3 mt-4">
                        <div class=" flex flex-wrap justify-between">
                            <span class="font-semibold">{{__('Total')}}:</span>
                            <span x-text="`$${currentProduct.price}`"></span>
                        </div>
                        <div class=" flex flex-wrap justify-between">
                            <span class="font-semibold">{{__('Transport')}}:</span>
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
    </section>
</x-app-layout>
