@extends('template.index')
@section('content')
    <div class="px-4 py-6 mx-auto max-w-3xl sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="/kartu" class="inline-flex items-center text-sm text-gray-500 hover:text-main transition-colors">
                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Tambah Kartu SIM Baru</h2>
            <form x-data="{
                nomor: '',
                ip: '',
                subnet: '',
                gateway: '',
                dns: '',
                kuota: '',
                sisa_kuota: '',
            }">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <x-input-label for="nomor" value="Nomor SIM Card" />
                        <x-text-input id="nomor" class="w-full" x-model="nomor" placeholder="08xxxxxxxxxx" />
                    </div>
                    <div>
                        <x-input-label for="ip" value="IP Address" />
                        <x-text-input x-model="ip" id="ip" class="w-full" placeholder="10.0.0.1" />
                    </div>
                    <div>
                        <x-input-label for="subnet" value="Subnet" />
                        <x-text-input x-model="subnet" id="subnet" class="w-full" placeholder="255.255.255.0" />
                    </div>
                    <div>
                        <x-input-label for="gateway" value="Gateway" />
                        <x-text-input x-model="gateway" id="gateway" class="w-full" placeholder="10.0.0.1" />
                    </div>
                    <div>
                        <x-input-label for="dns" value="DNS" />
                        <x-text-input x-model="dns" id="dns" class="w-full" placeholder="8.8.8.8" />
                    </div>
                    <div>
                        <x-input-label for="kuota" value="Kuota (GB)" />
                        <x-text-input type="number" step="0.1" min="0" x-model="kuota" id="kuota" class="w-full" placeholder="50" />
                    </div>
                    <div>
                        <x-input-label for="sisa_kuota" value="Sisa Kuota (GB)" />
                        <x-text-input type="number" step="0.1" min="0" x-model="sisa_kuota" id="sisa_kuota" class="w-full" placeholder="30" />
                    </div>
                </div>
                <div class="flex justify-end mt-8 space-x-3">
                    <a href="/kartu"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" x-on:click.prevent="onCreate"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-main rounded-xl transition-all duration-200 hover:bg-main-600 hover:shadow-md focus:ring-2 focus:ring-main-300 focus:outline-none">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Data
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function onCreate(e) {
            e.preventDefault()
            const metaTag = document.head.querySelector('meta[name="csrf-token"]');
            const postData = {
                nomor: this.nomor,
                ip: this.ip || null,
                subnet: this.subnet || null,
                gateway: this.gateway || null,
                dns: this.dns || null,
                kuota: this.kuota || null,
                sisa_kuota: this.sisa_kuota || null,
            };
            axios.post("/api/kartu", postData, {
                headers: { 'X-CSRF-Token': metaTag.getAttribute('content') }
            }).then(function(response) {
                Swal.fire({ title: "Berhasil !", icon: "success", timer: 1500 });
                setTimeout(() => window.location.href = "/kartu", 1000);
            });
        }
    </script>
@endsection
