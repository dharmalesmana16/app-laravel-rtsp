@extends('template.index')
@section('content')
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-template-create-data ref_url="/pekerjaan/create" label="Halaman Data Pekerjaan"></x-template-create-data>

        <div class="overflow-hidden bg-white border border-gray-200 rounded-2xl shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 font-semibold text-gray-600">No</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Nama Pekerjaan</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Vendor</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Alamat</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Tanggal</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody x-data="{ datas: [] }" x-init="axios.get('/api/pekerjaan').then(res => { datas = res.data.data })">
                        <template x-for="(data, index) in datas" :key="data.id">
                            <tr class="border-b border-gray-100 transition-colors hover:bg-gray-50/50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" x-text="data.id"></td>
                                <td class="px-6 py-4 font-medium text-gray-900" x-text="data.nama"></td>
                                <td class="px-6 py-4">
                                    <span x-text="data.vendor?.nama_perusahaan ?? '-'"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-main-100 text-main-800"></span>
                                </td>
                                <td class="px-6 py-4 text-gray-700" x-text="data.alamat ?? '-'"></td>
                                <td class="px-6 py-4 text-gray-700 whitespace-nowrap" x-text="data.tanggal ?? '-'"></td>
                                <td class="px-6 py-4">
                                    <span x-show="data.status === 'aktif'"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800" x-text="data.status">
                                    </span>
                                    <span x-show="data.status !== 'aktif'"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800" x-text="data.status">
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <a :href="`/pekerjaan/${data.id}/edit`"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-second-600 rounded-lg hover:bg-second-700 transition-colors">
                                            <svg class="w-3.5 h-3.5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="m13.586 3.586a2 2 0 0 1 2.828 0l.586.586a2 2 0 0 1 0 2.828l-8.586 8.586-3.414.586.586-3.414 8.586-8.586Z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <button @click="Swal.fire({ title: 'Hapus pekerjaan ini?', text: data.nama, icon: 'warning', showCancelButton: true, confirmButtonColor: '#ef4444', confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal' }).then(r => { if (r.isConfirmed) { axios.delete(`/api/pekerjaan/${data.id}`).then(() => { datas.splice(index,1); Swal.fire('Terhapus!', '', 'success') }) } })"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition-colors">
                                            <svg class="w-3.5 h-3.5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
