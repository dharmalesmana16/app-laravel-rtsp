@extends('template.index')
@section('content')
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-template-create-data ref_url="/user/create" label="Halaman User Setting"></x-template-create-data>

        <div class="overflow-hidden bg-white border border-gray-200 rounded-2xl shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 font-semibold text-gray-600">No</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Nama</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Email</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Role</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody x-data="{ datas: [] }" x-init="axios.get('/api/user').then(res => { datas = res.data.data })">
                        <template x-for="(data, index) in datas" :key="data.id">
                            <tr class="border-b border-gray-100 transition-colors hover:bg-gray-50/50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" x-text="data.id"></td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" x-text="data.name"></td>
                                <td class="px-6 py-4 text-gray-700" x-text="data.email"></td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                        :class="data.role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800'"
                                        x-text="data.role"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <a :href="`/user/${data.id}/edit`"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-second-600 rounded-lg hover:bg-second-700 transition-colors">
                                            Edit
                                        </a>
                                        <button @click="Swal.fire({ title: 'Hapus user ini?', text: data.name, icon: 'warning', showCancelButton: true, confirmButtonColor: '#ef4444', confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal' }).then(r => { if (r.isConfirmed) { axios.delete(`/api/user/${data.id}`).then(() => { datas.splice(index,1); Swal.fire('Terhapus!', '', 'success') }) } })"
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
