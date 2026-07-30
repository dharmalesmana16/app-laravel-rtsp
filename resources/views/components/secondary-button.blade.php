<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-main focus:ring-offset-2 transition-all duration-200']) }}>
    {{ $slot }}
</button>
