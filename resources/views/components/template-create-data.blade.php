@props([
    'label' => '',
    'ref_url' => '',
])
<div>
    <div class="flex items-center justify-between py-5">
        <div>
            <h1 class="text-xl font-bold text-gray-900">{{ $label }}</h1>
        </div>
        <div>
            <x-button-link link="{{ $ref_url }}">Tambah Data</x-button-link>
        </div>
    </div>
</div>
