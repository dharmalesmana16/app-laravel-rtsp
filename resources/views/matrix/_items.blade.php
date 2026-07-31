@forelse ($groups as $vendorName => $cameras)
    <div class="flex items-center mb-4 space-x-3">
        <div class="p-2.5 bg-main rounded-xl shadow-sm">
            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M0 2a2 2 0 0 1 2-2h7l2 2h7a2 2 0 0 1 2 2v2H0V2Zm0 4v11a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6H0Z" />
            </svg>
        </div>
        <h1 class="text-xl font-bold text-gray-900">{{ $vendorName }}</h1>
        <span class="px-2.5 py-0.5 text-xs font-medium bg-main-100 text-main-800 rounded-full">{{ $cameras->count() }} Kamera</span>
    </div>
    <div class="grid grid-cols-1 gap-5 mb-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($cameras as $camera)
            <div data-stream-card data-camera-id="{{ $camera->id }}" data-port="{{ $camera->http_port }}"
                class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden transition-all duration-200 hover:shadow-md">
                <div class="relative bg-gray-900">
                    <canvas data-stream-canvas
                        class="w-full h-48 object-cover" style="image-rendering:pixelated; background:#000;"></canvas>
                    @if ($camera->last_on && $camera->last_on->gt(now()->subMinutes(2)))
                        <span class="absolute top-2 left-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-500 text-white shadow-sm">
                            <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span>
                            LIVE
                        </span>
                    @else
                        <span class="absolute top-2 left-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-500 text-white shadow-sm">
                            OFFLINE
                        </span>
                    @endif
                    <span class="absolute top-2 right-2 px-2 py-0.5 text-xs font-medium bg-black/50 text-white rounded-full backdrop-blur-sm">
                        Port {{ $camera->http_port }}
                    </span>
                </div>
                <div class="p-4">
                    <h5 class="text-lg font-bold text-gray-900">{{ $camera->ip }}</h5>
                    <div class="mt-2 space-y-1">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M18 2h-2V1a1 1 0 0 0-2 0v1h-2V1a1 1 0 0 0-2 0v1H8V1a1 1 0 0 0-2 0v1H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2Z" />
                            </svg>
                            Brand: <span class="ml-1 font-medium">{{ $camera->brand ?? '-' }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M0 2a2 2 0 0 1 2-2h7l2 2h7a2 2 0 0 1 2 2v2H0V2Zm0 4v11a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6H0Z" />
                            </svg>
                            Tipe: <span class="ml-1 font-medium">{{ $camera->tipe ?? '-' }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                            </svg>
                            Channel: <span class="ml-1 font-medium">{{ $camera->channel ?? '-' }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                            </svg>
                            Resolusi: <span class="ml-1 font-medium">{{ $camera->resolusi ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button data-stream-open data-port="{{ $camera->http_port }}"
                            class="inline-flex items-center justify-center w-full px-4 py-2.5 text-sm font-medium text-white bg-main rounded-xl transition-colors duration-150 hover:bg-main-600 shadow-sm">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                            </svg>
                            Lihat Streaming
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@empty
    <div class="py-16 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M4.5 3A2.5 2.5 0 0 0 2 5.5V11h16V5.5A2.5 2.5 0 0 0 15.5 3h-11Z" />
            <path d="M18 13H2v1.5A2.5 2.5 0 0 0 4.5 17h11a2.5 2.5 0 0 0 2.5-2.5V13Z" />
        </svg>
        <p class="mt-4 text-lg text-gray-500">Belum ada camera tersedia</p>
        <a href="/camera/create" class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium text-white bg-main rounded-xl hover:bg-main-600 transition-colors">
            Tambah CCTV
        </a>
    </div>
@endforelse
