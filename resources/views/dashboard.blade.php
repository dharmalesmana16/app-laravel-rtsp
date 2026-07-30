<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="p-5 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Vendor</p>
                            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $totalVendors }}</p>
                        </div>
                        <div class="p-3 bg-main-100 rounded-xl">
                            <svg class="w-6 h-6 text-main" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M0 2a2 2 0 0 1 2-2h7l2 2h7a2 2 0 0 1 2 2v2H0V2Zm0 4v11a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6H0Z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-5 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total CCTV</p>
                            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $totalCameras }}</p>
                        </div>
                        <div class="p-3 bg-main-100 rounded-xl">
                            <svg class="w-6 h-6 text-main" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4.5 3A2.5 2.5 0 0 0 2 5.5V11h16V5.5A2.5 2.5 0 0 0 15.5 3h-11Z" />
                                <path d="M18 13H2v1.5A2.5 2.5 0 0 0 4.5 17h11a2.5 2.5 0 0 0 2.5-2.5V13Z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-5 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Online</p>
                            <p class="mt-1 text-3xl font-bold text-green-600">{{ $camerasOnline }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-xl">
                            <svg class="w-6 h-6 text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-5 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Offline</p>
                            <p class="mt-1 text-3xl font-bold text-red-600">{{ $camerasOffline }}</p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-xl">
                            <svg class="w-6 h-6 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 0 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 mt-8 lg:grid-cols-2">
                <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="mb-4 text-lg font-bold text-gray-900">CCTV Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="py-3 pr-4 font-semibold text-gray-600">IP</th>
                                    <th class="py-3 pr-4 font-semibold text-gray-600">Brand</th>
                                    <th class="py-3 pr-4 font-semibold text-gray-600">Vendor</th>
                                    <th class="py-3 font-semibold text-gray-600">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latestCameras as $camera)
                                    <tr class="border-b border-gray-50 hover:bg-gray-50/50">
                                        <td class="py-3 pr-4 font-medium text-gray-900">{{ $camera->ip }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $camera->brand ?? '-' }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $camera->vendor->nama_perusahaan ?? '-' }}</td>
                                        <td class="py-3">
                                            @if ($camera->last_on)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Online</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Offline</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="py-4 text-center text-gray-500">Belum ada data CCTV</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="mb-4 text-lg font-bold text-gray-900">Vendor Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="py-3 pr-4 font-semibold text-gray-600">Nama</th>
                                    <th class="py-3 pr-4 font-semibold text-gray-600">PIC</th>
                                    <th class="py-3 font-semibold text-gray-600">Jumlah CCTV</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vendors as $vendor)
                                    <tr class="border-b border-gray-50 hover:bg-gray-50/50">
                                        <td class="py-3 pr-4 font-medium text-gray-900">{{ $vendor->nama_perusahaan }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $vendor->pic ?? '-' }}</td>
                                        <td class="py-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-main-100 text-main-800">{{ $vendor->cameras_count }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="py-4 text-center text-gray-500">Belum ada data vendor</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 mt-8 sm:grid-cols-3">
                <a href="{{ url('/matrix') }}"
                    class="group p-6 bg-white rounded-2xl shadow-sm border border-gray-100 transition-all duration-200 hover:shadow-md hover:border-main/20 hover:-translate-y-0.5">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-second-100 rounded-xl group-hover:bg-second-200 transition-colors">
                            <svg class="w-6 h-6 text-second-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Video Wall</h3>
                            <p class="text-sm text-gray-500">Monitoring streaming kamera</p>
                        </div>
                    </div>
                </a>
                <a href="{{ url('/camera') }}"
                    class="group p-6 bg-white rounded-2xl shadow-sm border border-gray-100 transition-all duration-200 hover:shadow-md hover:border-main/20 hover:-translate-y-0.5">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-main-100 rounded-xl group-hover:bg-main-200 transition-colors">
                            <svg class="w-6 h-6 text-main" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4.5 3A2.5 2.5 0 0 0 2 5.5V11h16V5.5A2.5 2.5 0 0 0 15.5 3h-11Z" />
                                <path d="M18 13H2v1.5A2.5 2.5 0 0 0 4.5 17h11a2.5 2.5 0 0 0 2.5-2.5V13Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Data Camera</h3>
                            <p class="text-sm text-gray-500">Kelola data CCTV</p>
                        </div>
                    </div>
                </a>
                <a href="{{ url('/vendor') }}"
                    class="group p-6 bg-white rounded-2xl shadow-sm border border-gray-100 transition-all duration-200 hover:shadow-md hover:border-main/20 hover:-translate-y-0.5">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-second-100 rounded-xl group-hover:bg-second-200 transition-colors">
                            <svg class="w-6 h-6 text-second-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M0 2a2 2 0 0 1 2-2h7l2 2h7a2 2 0 0 1 2 2v2H0V2Zm0 4v11a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6H0Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Data Vendor</h3>
                            <p class="text-sm text-gray-500">Kelola data vendor</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
