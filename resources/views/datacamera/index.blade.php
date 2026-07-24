@extends('template.index')
@section('content')
    <div class="mx-auto container">
        <x-template-create-data ref_url="/camera/create" label="Halaman Data CCTV"></x-template-create-data>

        <div
            class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default bg-white rounded-2xl">
            <table class="w-full text-sm text-left rtl:text-right text-body">
                <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            IP
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Channel
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            WS Port
                        </th>

                    </tr>
                </thead>
                <tbody x-data="{ datas: [] }" x-init="fetch('/api/camera').then(response => response.json()).then(data => { datas = data.data })">
                    <template x-for="team in datas">

                        <tr class="bg-neutral-primary border-b border-default">
                            <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap"
                                x-text="team.id">

                            </th>
                            <td class="px-6 py-4" x-text="team.ip">
                            </td>
                            <td class="px-6 py-4" x-text="team.channel">
                            </td>
                            <td class="px-6 py-4" x-text="team.http_port">
                            </td>

                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
    <script></script>
@endsection
