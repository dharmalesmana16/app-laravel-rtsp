@extends('template.index')
@section('content')
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-template-create-data ref_url="/camera/create" label="Halaman Data CCTV"></x-template-create-data>

        <div class="overflow-hidden bg-white border border-gray-200 rounded-2xl shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 font-semibold text-gray-600">No</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">IP</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Brand</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Tipe</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Channel</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">WS Port</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Vendor</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody x-data="{ datas: [] }" x-init="axios.get('/api/camera').then(res => { datas = res.data.data })">
                        <template x-for="(data, index) in datas" :key="data.id">
                            <tr class="border-b border-gray-100 transition-colors hover:bg-gray-50/50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" x-text="data.id"></td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" x-text="data.ip"></td>
                                <td class="px-6 py-4 text-gray-700 whitespace-nowrap" x-text="data.brand ?? '-'"></td>
                                <td class="px-6 py-4 text-gray-700 whitespace-nowrap" x-text="data.tipe ?? '-'"></td>
                                <td class="px-6 py-4 text-gray-700" x-text="data.channel ?? '-'"></td>
                                <td class="px-6 py-4"><span class="font-mono text-sm text-gray-700" x-text="data.http_port"></span></td>
                                <td class="px-6 py-4 text-gray-700 whitespace-nowrap" x-text="data.vendor_name ?? '-'"></td>
                                <td class="px-6 py-4">
                                    <span x-show="data.last_on"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Online</span>
                                    <span x-show="!data.last_on"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Offline</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <a :href="`/camera/${data.id}/edit`"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-second-600 rounded-lg hover:bg-second-700 transition-colors">
                                            Edit
                                        </a>
                                        <button @click="Swal.fire({ title: 'Hapus CCTV ini?', text: data.ip, icon: 'warning', showCancelButton: true, confirmButtonColor: '#ef4444', confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal' }).then(r => { if (r.isConfirmed) { axios.delete(`/api/camera/${data.id}`).then(() => { datas.splice(index,1); Swal.fire('Terhapus!', '', 'success') }) } })"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition-colors">
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
