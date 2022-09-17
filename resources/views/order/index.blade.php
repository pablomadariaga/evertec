<x-app-layout>
    <x-slot name="header">
        {{ __('Orders') }}
    </x-slot>
    <section x-data="ordersData" class="child-transition-color">
        <div class="grid grid-cols-1 gap-3 text-slate-600 dark:text-slate-300 md:grid-cols-2 md:gap-10">
            <template x-for="order in orders" :key="order.id">
                <div class="-intro-x bg-white dark:bg-slate-1000 rounded-lg shadow p-5 flex flex-wrap">
                    <h5 class="mb-3 font-semibold text-slate-900 dark:text-slate-50" x-text="order.reference"></h5>
                    <div class="ml-auto text-xs font-bold text-slate-50">

                       <p><x-order-badge /> {{__('Order')}} # <span x-text="order.id"></span></p>
                    </div>
                    <p class="text-sm mt-3 w-full"><span class="font-semibold text-slate-900 dark:text-slate-50">{{__('Total')}}:</span> $<span x-text="order.total" ></span></p>
                    <p class="w-full text-xs mt-3" x-text="order.created_at"></p>
                    <div class="w-full mt-4">
                        <x-button class="w-full" :link="true" x-bind:href="`{{ url('order') }}/${order.id}`" label="{{__('See details')}}"/>
                    </div>
                </div>
            </template>
        </div>
    </section>
</x-app-layout>
