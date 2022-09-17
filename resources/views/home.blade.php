<x-app-layout>
    <x-slot name="header">
        {{ __('Products') }}
    </x-slot>
    <section x-data="productsData" class="child-transition-color">
        <div class="grid grid-cols-1 gap-3 text-slate-600 dark:text-slate-300 md:grid-cols-2 md:gap-12">
            <template x-for="product in products" :key="product.id">
                <div class="-intro-x bg-white dark:bg-slate-1000 rounded-lg shadow p-5 flex flex-wrap ">
                    <h5 class="mb-3 font-semibold text-slate-900 dark:text-slate-50" x-text="product.name"></h5>
                    <p class="text-justify w-full" x-text="product.description"></p>
                    <p class="text-sm mt-3 w-full"><span class="font-semibold text-slate-900 dark:text-slate-50">{{__('Price')}}:</span> $<span x-text="product.price" ></span></p>
                    <div class="ml-auto mt-4">
                        <x-button :link="true" x-bind:href="`{{ route('order.create') }}?product=${product.id}`" label="{{__('Buy')}}"/>
                    </div>
                </div>
            </template>
        </div>
    </section>
</x-app-layout>
