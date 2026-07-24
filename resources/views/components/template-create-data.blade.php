@props([
    'label' => '',
    'ref_url' => '',
])
<div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
    <div class="flex justify-between py-5">
        <div class="bg-white shadow-sm px-4 py-2 rounded-xl">
            <p class="text-gray-800 font-bold">{{ $label }}</p>
        </div>
        <div class="">
            {{-- <button type="button"
                class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Lime</button> --}}
            <x-button-link link="{{ $ref_url }}">Tambah Data </x-button-link>
        </div>
    </div>
</div>
