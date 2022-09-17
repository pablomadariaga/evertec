<div class="relative w-full px-8 text-slate-800 dark:text-evertec-50 overflow-x-hidden">
    <div class="container relative flex flex-col flex-wrap items-center justify-between py-5 mx-auto md:flex-row max-w-7xl">
        <a href="#_" class="relative z-10 flex items-center w-auto text-2xl font-extrabold leading-none text-black select-none -intro-x">
            <x-evertec.logo class="h-7 w-auto"/>
        </a>
        <nav class="top-0 left-0 z-0 flex items-center justify-center w-full h-full py-5 space-x-5 text-base md:py-0 md:absolute -intro-y">
            <a href="{{ route('home') }}" class="relative font-medium leading-6 transition duration-150 ease-out hover:text-slate-900 dark:hover:text-white" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <span class="block">{{__('Products')}}</span>
                <span class="absolute bottom-0 left-0 inline-block w-full h-0.5 -mb-1 overflow-hidden">
                    <span x-show="hover" class="absolute inset-0 inline-block w-full h-1 transform bg-slate-900 dark:bg-evertec-200" x-transition:enter="transition ease duration-200" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="transition ease-out duration-300" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0" style="display: none;"></span>
                </span>
            </a>
            <a href="{{ route('order.create') }}" class="relative font-medium leading-6 transition duration-150 ease-out hover:text-slate-900 dark:hover:text-white" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <span class="block">{{__('Make an order')}}</span>
                <span class="absolute bottom-0 left-0 inline-block w-full h-0.5 -mb-1 overflow-hidden">
                    <span x-show="hover" class="absolute inset-0 inline-block w-full h-1 transform bg-slate-900 dark:bg-evertec-200" x-transition:enter="transition ease duration-200" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="transition ease-out duration-300" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0" style="display: none;"></span>
                </span>
            </a>
            <a href="{{route('order.index')}}" class="relative font-medium leading-6 transition duration-150 ease-out hover:text-slate-900 dark:hover:text-white" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                <span class="block">{{__('Orders')}}</span>
                <span class="absolute bottom-0 left-0 inline-block w-full h-0.5 -mb-1 overflow-hidden">
                    <span x-show="hover" class="absolute inset-0 inline-block w-full h-1 transform bg-slate-900 dark:bg-evertec-200" x-transition:enter="transition ease duration-200" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="transition ease-out duration-300" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0" style="display: none;"></span>
                </span>
            </a>
        </nav>

        <div class="absolute top-8 md:top-1/2 -translate-y-1/2 -right-3 md:right-2 z-50 inline-flex items-center md:ml-5 lg:justify-end">
            <span x-bind="toggleTheme"
                class="cursor-pointer h-6 w-6 inline-flex relative items-center dark:text-white text-evertec-600  text-opacity-70 font-semibold text-sm hover:text-opacity-100 intro-x">
                <span class="mx-auto absolute" style="display: none" x-show="!dark" x-transition.duration.300ms x-tooltip.raw="{{__('Dark')}}">
                    <x-icon.moon class="h-6 w-6" />
                </span>
                <span class="mx-auto absolute" style="display: none" x-show="dark" x-transition.duration.300ms x-tooltip.raw="{{__('Light')}}">
                    <x-icon.sun class="h-6 w-6" />
                </span>
            </span>
        </div>
    </div>
</div>
