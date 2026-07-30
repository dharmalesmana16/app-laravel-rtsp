@props([
    'link' => '',
])
<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-main rounded-xl shadow-sm transition-all duration-200 hover:bg-main-600 hover:shadow-md focus:ring-2 focus:ring-main-300 focus:outline-none']) }}>
    <a href="{{ $link }}">
        {{ $slot }}
    </a>
</button>
