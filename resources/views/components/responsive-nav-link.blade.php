@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center w-full px-3 py-2 text-sm font-medium text-white bg-white/20 rounded-lg transition-colors duration-150'
            : 'flex items-center w-full px-3 py-2 text-sm font-medium text-white/80 rounded-lg transition-colors duration-150 hover:bg-white/10 hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
