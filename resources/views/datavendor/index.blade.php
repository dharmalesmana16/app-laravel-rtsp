@extends('template.index')
@section('content')
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-template-create-data ref_url="/vendor/create" label="Halaman Data Vendor"></x-template-create-data>

        <div class="overflow-hidden bg-white border border-gray-200 rounded-2xl shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 font-semibold text-gray-600">No</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Nama Vendor</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">PIC</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Contact Person</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Email</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Kota</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Jumlah CCTV</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody x-data="{ teams: [] }" x-init="axios.get('/api/vendor').then(res => { teams = res.data.data })">
                        <template x-for="(team, index) in teams" :key="team.id">
                            <tr class="border-b border-gray-100 transition-colors hover:bg-gray-50/50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" x-text="team.id"></td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" x-text="team.nama_perusahaan"></td>
                                <td class="px-6 py-4 text-gray-700 whitespace-nowrap" x-text="team.pic ?? '-'"></td>
                                <td class="px-6 py-4 text-gray-700 whitespace-nowrap" x-text="team.cp ?? '-'"></td>
                                <td class="px-6 py-4 text-gray-700" x-text="team.email_perusahaan ?? '-'"></td>
                                <td class="px-6 py-4 text-gray-700" x-text="team.kota ?? '-'"></td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-main-100 text-main-800" x-text="team.cameras_count ?? 0"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <a :href="`/vendor/${team.id}/edit`"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-second-600 rounded-lg hover:bg-second-700 transition-colors">
                                            Edit
                                        </a>
                                        <button @click="Swal.fire({ title: 'Hapus vendor ini?', text: team.nama_perusahaan, icon: 'warning', showCancelButton: true, confirmButtonColor: '#ef4444', confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal' }).then(r => { if (r.isConfirmed) { axios.delete(`/api/vendor/${team.id}`).then(() => { teams.splice(index,1); Swal.fire('Terhapus!', '', 'success') }) } })"
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
