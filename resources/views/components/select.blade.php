@props(['label' => null, 'error' => false, 'wrapperClass' => 'w-full'])
@error($attributes->get('name')??'')
    @php
        $error = true;
    @endphp
@enderror
@if ($label)
<label for="{{$attributes->get('id')}}" class="block text-sm font-medium text-slate-700 dark:text-slate-400">{{$label}}</label>
@endif
<div class="{{$wrapperClass}}">
    <select {{$attributes->merge(['type' => 'text', 'class' => ($error ? 'invalid ' : '').'placeholder-slate-400 dark:bg-slate-900 dark:bg-opacity-50 dark:text-slate-400 dark:placeholder-slate-500 border border-slate-300 focus:ring-evertec-500 focus:border-evertec-500 dark:border-slate-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pr-8'])}}>
        {{$slot}}
    </select>
    @error($attributes->get('name'))
        <p class="error-message">{{$message}}</p>
    @enderror
</div>
