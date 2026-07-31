@extends('template.index')
@section('content')
    <div class="px-4 py-6 mx-auto max-w-3xl sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="/pekerjaan" class="inline-flex items-center text-sm text-gray-500 hover:text-main transition-colors">
                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Tambah Pekerjaan Baru</h2>
            <form x-data="{
                errors: {},
                nama: '',
                alamat: '',
                deskripsi: '',
                tanggal: '',
                status: 'aktif',
                vendor_id: '',
                allVendors: [],
                init() {
                    axios.get('/api/vendor?per_page=200').then(res => {
                        this.allVendors = res.data.data
                    })
                }
            }">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-input-label for="nama" value="Nama Pekerjaan" />
                        <x-text-input id="nama" class="w-full" x-model="nama" placeholder="Nama pekerjaan" x-bind:class="errors.nama ? '!border-red-500' : ''" />
                        <x-field-error name="nama" />
                    </div>
                    <div>
                        <x-input-label for="vendor" value="Vendor" />
                        <select x-model="vendor_id" id="vendor"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-main focus:border-main block w-full p-2.5 transition-all duration-200"
                            x-bind:class="errors.vendor_id ? '!border-red-500' : ''">
                            <option value="">-- Pilih Vendor --</option>
                            <template x-for="v in allVendors" :key="v.id">
                                <option :value="v.id" x-text="v.nama_perusahaan"></option>
                            </template>
                        </select>
                        <x-field-error name="vendor_id" />
                    </div>
                    <div>
                        <x-input-label for="alamat" value="Alamat" />
                        <textarea x-model="alamat" id="alamat"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-main focus:border-main block w-full p-2.5 transition-all duration-200"
                            x-bind:class="errors.alamat ? '!border-red-500' : ''"
                            rows="2" placeholder="Alamat lokasi pekerjaan"></textarea>
                        <x-field-error name="alamat" />
                    </div>
                    <div>
                        <x-input-label for="deskripsi" value="Deskripsi" />
                        <textarea x-model="deskripsi" id="deskripsi"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-main focus:border-main block w-full p-2.5 transition-all duration-200"
                            x-bind:class="errors.deskripsi ? '!border-red-500' : ''"
                            rows="3" placeholder="Deskripsi pekerjaan"></textarea>
                        <x-field-error name="deskripsi" />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="tanggal" value="Tanggal" />
                            <x-text-input type="date" x-model="tanggal" id="tanggal" class="w-full" x-bind:class="errors.tanggal ? '!border-red-500' : ''" />
                            <x-field-error name="tanggal" />
                        </div>
                        <div>
                            <x-input-label for="status" value="Status" />
                            <select x-model="status" id="status"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-main focus:border-main block w-full p-2.5 transition-all duration-200"
                                x-bind:class="errors.status ? '!border-red-500' : ''">
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                                <option value="batal">Batal</option>
                                <option value="pending">Pending</option>
                            </select>
                            <x-field-error name="status" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-8 space-x-3">
                    <a href="/pekerjaan"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" x-on:click.prevent="onCreate"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-main rounded-xl transition-all duration-200 hover:bg-main-600 hover:shadow-md focus:ring-2 focus:ring-main-300 focus:outline-none">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function onCreate(e) {
            e.preventDefault()
            this.errors = {};
            const metaTag = document.head.querySelector('meta[name="csrf-token"]');
            const postData = {
                nama: this.nama,
                alamat: this.alamat,
                deskripsi: this.deskripsi,
                tanggal: this.tanggal,
                status: this.status,
                vendor_id: this.vendor_id || null,
            };
            axios.post("/api/pekerjaan", postData, {
                headers: { 'X-CSRF-Token': metaTag.getAttribute('content') }
            }).then(function(response) {
                Swal.fire({ title: "Berhasil !", icon: "success", timer: 1500 });
                setTimeout(() => window.location.href = "/pekerjaan", 1000);
            }).catch((error) => {
                applyFormErrors(this, error);
            });
        }
    </script>
@endsection
