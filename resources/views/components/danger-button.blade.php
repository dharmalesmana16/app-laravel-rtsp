<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-xl shadow-sm hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition-all duration-200']) }}>
    {{ $slot }}
</button>
