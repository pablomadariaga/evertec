
@props(['label' => null, 'link' => false, 'size' => 'md'])
@php
    switch ($size) {
        case 'xs':
            $size = 'text-xs px-2 py-1';
            break;
        case 'sm':
            $size = 'text-sm px-3 py-1.5';
            break;

        default:
            $size = 'text-sm px-4 py-2';
            break;
    }
    $class = $size." outline-none inline-flex justify-center items-center group transition-all
    ease-in duration-150 focus:ring-2 focus:ring-offset-2 hover:shadow-sm disabled:opacity-80
    disabled:cursor-not-allowed rounded gap-x-2 ring-evertec-500 text-white bg-evertec-500
    hover:bg-evertec-700 hover:ring-evertec-600 dark:ring-offset-slate-800 dark:bg-transparent dark:border-evertec-600 border dark:ring-evertec-700
    dark:hover:bg-evertec-600 dark:hover:ring-evertec-600";
@endphp
@if ($link)
<a {{$attributes->merge(['class' => $class])}}>
    {!! $label ?? $slot !!}
</a>
@else
<button {{$attributes->merge(['class' => $class])}}>
    {!! $label ?? $slot !!}
</button>
@endif
