@props(['order' => null])
@if ($order)
    @switch($order->order_state_id->value)
        @case(2)
        <span class="px-2 py-1 rounded-3xl text-sm font-bold text-slate-50 dark:text-slate-800 bg-teal-600 dark:bg-teal-300">
            {{$order->order_state_id->label()}}
        </span>
        @break
        @case(3)
        <span class="px-2 py-1 rounded-3xl text-sm font-bold text-slate-50 dark:text-slate-800 bg-rose-600 dark:bg-rose-300">
            {{$order->order_state_id->label()}}
        </span>
        @break
        @case(4)
        <span class="px-2 py-1 rounded-3xl text-sm font-bold text-slate-50 dark:text-slate-800 bg-slate-600 dark:bg-slate-300">
            {{$order->order_state_id->label()}}
        </span>
        @break
        @default
        <span
            class="px-2 py-1 rounded-3xl text-sm font-bold text-slate-50 dark:text-slate-800 bg-indigo-600 dark:bg-indigo-300">
            {{$order->order_state_id->label()}}
        </span>
    @endswitch
@else

    <div class="w-2.5 h-2.5 inline-block rounded-full shadow" x-bind:class="{
        'bg-indigo-600 dark:bg-indigo-400': order.order_state_id==1,
        'bg-teal-600 dark:bg-teal-400': order.order_state_id==2,
        'bg-rose-600 dark:bg-rose-400': order.order_state_id==3,
        'bg-slate-600 dark:bg-slate-400': order.order_state_id==4,
    }" x-tooltip="()=>{
        let tooltip = '';
        switch (order.order_state_id) {
            case 2:
                tooltip = '{{__('Payed')}}'
              break;
            case 3:
                tooltip = '{{__('Rejected')}}'
              break;
            case 4:
                tooltip = '{{__('Pending')}}'
              break;
            default:
                tooltip = '{{__('Created')}}';
        }
        return tooltip;
    }">
    </div>
@endif
