@extends('template.index')
@section('content')
    <div class="px-4 py-6 mx-auto max-w-3xl sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="/vendor" class="inline-flex items-center text-sm text-gray-500 hover:text-main transition-colors">
                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Edit Vendor</h2>
            <form x-data="{
                id: {{ request()->route('vendor') }},
                nama_perusahaan: '',
                pic: '',
                alamat: '',
                cp: '',
                provinsi: '',
                kota: '',
                kode_pos: '',
                kecamatan: '',
                email_perusahaan: '',
                init() {
                    axios.get(`/api/vendor/${this.id}`).then(res => {
                        const d = res.data.data
                        this.nama_perusahaan = d.nama_perusahaan
                        this.pic = d.pic || ''
                        this.alamat = d.alamat || ''
                        this.cp = d.cp || ''
                        this.provinsi = d.provinsi || ''
                        this.kota = d.kota || ''
                        this.kode_pos = d.kode_pos || ''
                        this.kecamatan = d.kecamatan || ''
                        this.email_perusahaan = d.email_perusahaan || ''
                    })
                }
            }">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <x-input-label for="nama_perusahaan" value="Nama Perusahaan" />
                        <x-text-input id="nama_perusahaan" class="w-full" x-model="nama_perusahaan" />
                    </div>
                    <div>
                        <x-input-label for="pic" value="Nama PIC" />
                        <x-text-input x-model="pic" id="pic" class="w-full" />
                    </div>
                    <div>
                        <x-input-label for="cp" value="Nomor Telephone / Whatsapp" />
                        <x-text-input x-model="cp" id="cp" class="w-full" />
                    </div>
                    <div>
                        <x-input-label for="email_perusahaan" value="Email" />
                        <x-text-input x-model="email_perusahaan" id="email_perusahaan" class="w-full" />
                    </div>
                    <div>
                        <x-input-label for="kode_pos" value="Kode Pos" />
                        <x-text-input x-model="kode_pos" id="kode_pos" class="w-full" />
                    </div>
                    <div class="sm:col-span-2">
                        <x-input-label for="alamat" value="Alamat" />
                        <textarea x-model="alamat" id="alamat"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-main focus:border-main block w-full p-2.5 transition-all duration-200"
                            rows="2"></textarea>
                    </div>
                    <div>
                        <x-input-label for="provinsi" value="Provinsi" />
                        <x-text-input x-model="provinsi" id="provinsi" class="w-full" />
                    </div>
                    <div>
                        <x-input-label for="kota" value="Kota / Kabupaten" />
                        <x-text-input x-model="kota" id="kota" class="w-full" />
                    </div>
                </div>
                <div class="flex justify-end mt-8 space-x-3">
                    <a href="/vendor"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" x-on:click.prevent="onUpdate"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-main rounded-xl transition-all duration-200 hover:bg-main-600 hover:shadow-md focus:ring-2 focus:ring-main-300 focus:outline-none">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function onUpdate(e) {
            e.preventDefault()
            const metaTag = document.head.querySelector('meta[name="csrf-token"]');
            const postData = {
                nama_perusahaan: this.nama_perusahaan,
                pic: this.pic,
                alamat: this.alamat,
                cp: this.cp,
                provinsi: this.provinsi,
                kota: this.kota,
                kode_pos: this.kode_pos,
                kecamatan: this.kecamatan,
                email_perusahaan: this.email_perusahaan
            };
            axios.put(`/api/vendor/${this.id}`, postData, {
                headers: { 'X-CSRF-Token': metaTag.getAttribute('content') }
            }).then(function(response) {
                Swal.fire({ title: "Berhasil !", icon: "success", timer: 1500 });
                setTimeout(() => window.location.href = "/vendor", 1000);
            });
        }
    </script>
@endsection
