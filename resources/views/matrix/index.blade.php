@extends('template.index')
@section('content')
    <div class="mt-4 mx-auto block p-4">

        <div class="bg-white shadow-md p-5 mb-3 rounded-3xl">
            <h1>Vendor 1</h1>
        </div>
        <div class="grid grid-cols-4 gap-4 mx-auto block ">

            @foreach ($res as $req => $index)
                <div x-data="{
                    openModal: false,
                    mainStreaming: false,
                }">
                    <div
                        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div>
                            <canvas id={{ 'chanel' . $req }} width="50" height="50" x-ref="mainStreaming"
                                class="mainStreaming p-2 h-[250px]" style="width:100%"></canvas>
                        </div>
                        <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Proyek
                                {{ $req }}</h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">Channel:
                                {{ $index['channel'] }}</p>
                            <p class="font-normal text-gray-700 dark:text-gray-400">Status:
                                Aktif</p>
                            <x-modal-view-streaming id_canvas="{{ $req }}"
                                modalport="{{ $index['port'] }}"></x-modal-view-streaming>



                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
<script>
    function handleView() {
        this.openModal = true
    }
    let canvas = document.getElementById("chanel1")
</script>
