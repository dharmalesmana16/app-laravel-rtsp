@extends('template.index')
@section('content')
    <div class="mx-auto container">
        <x-template-create-data ref_url="/vendor/create" label="Halaman Data Vendor"></x-template-create-data>

        <div
            class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default bg-white rounded-2xl">
            <table class="w-full text-sm text-left rtl:text-right text-body">
                <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Nama Vendor
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            PIC
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Contact Person
                        </th>

                    </tr>
                </thead>
                <tbody x-data="{ teams: [] }" x-init="fetch('/api/vendor').then(response => response.json()).then(data => { teams = data.data })">
                    <template x-for="team in teams">

                        <tr class="bg-neutral-primary border-b border-default">
                            <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap"
                                x-text="team.id">

                            </th>
                            <td class="px-6 py-4" x-text="team.nama_perusahaan">
                            </td>
                            <td class="px-6 py-4" x-text="item.pic">
                            </td>
                            <td class="px-6 py-4" x-text="item.cp">
                            </td>

                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
    <script></script>
@endsection
