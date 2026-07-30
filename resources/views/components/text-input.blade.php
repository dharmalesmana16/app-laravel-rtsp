@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-main focus:border-main block w-full p-2.5 transition-all duration-200']) }}>
