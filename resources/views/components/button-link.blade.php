@props([
    'link' => '',
])

<a href="{{ $link }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-main rounded-xl shadow-sm transition-all duration-200 hover:bg-main-600 hover:shadow-md focus:ring-2 focus:ring-main-300 focus:outline-none']) }}>
    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    {{ $slot }}
</a>
