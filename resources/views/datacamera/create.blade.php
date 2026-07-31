@extends('template.index')
@section('content')
    <div class="px-4 py-6 mx-auto max-w-3xl sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="/camera" class="inline-flex items-center text-sm text-gray-500 hover:text-main transition-colors">
                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Tambah CCTV Baru</h2>
            <form x-data="{
                errors: {},
                ip: '',
                mac: '',
                resolusi: '',
                auth_user: '',
                auth_password: '',
                tipe: '',
                brand: '',
                latitude: '',
                longitude: '',
                vendor_id: '',
                kartu_id: '',
                channel: '',
                allVendors: [],
                allKartu: [],
                init() {
                    axios.get('/api/vendor?per_page=200').then(res => {
                        this.allVendors = res.data.data
                    })
                    axios.get('/api/kartu?per_page=200').then(res => {
                        this.allKartu = res.data.data
                    })
                }
            }">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <x-input-label for="ip" value="IP Camera" />
                        <x-text-input id="ip" class="w-full" x-model="ip" placeholder="192.168.1.100" x-bind:class="errors.ip ? '!border-red-500' : ''" />
                        <x-field-error name="ip" />
                    </div>
                    <div>
                        <x-input-label for="mac" value="Alamat MAC" />
                        <x-text-input x-model="mac" id="mac" class="w-full" placeholder="AA:BB:CC:DD:EE:FF" x-bind:class="errors.mac ? '!border-red-500' : ''" />
                        <x-field-error name="mac" />
                    </div>
                    <div>
                        <x-input-label for="channel" value="Channel" />
                        <x-text-input x-model="channel" id="channel" class="w-full" placeholder="1" x-bind:class="errors.channel ? '!border-red-500' : ''" />
                        <x-field-error name="channel" />
                    </div>
                    <div>
                        <x-input-label for="brand" value="Brand" />
                        <x-text-input x-model="brand" id="brand" class="w-full" placeholder="EZVIZ / DAHUA / HIKVISION" x-bind:class="errors.brand ? '!border-red-500' : ''" />
                        <x-field-error name="brand" />
                    </div>
                    <div>
                        <x-input-label for="tipe" value="Tipe CCTV" />
                        <x-text-input x-model="tipe" id="tipe" class="w-full" placeholder="Tipe camera" x-bind:class="errors.tipe ? '!border-red-500' : ''" />
                        <x-field-error name="tipe" />
                    </div>
                    <div>
                        <x-input-label for="resolusi" value="Resolusi" />
                        <x-text-input x-model="resolusi" id="resolusi" class="w-full" placeholder="1080p / 4MP / 8MP" x-bind:class="errors.resolusi ? '!border-red-500' : ''" />
                        <x-field-error name="resolusi" />
                    </div>
                    <div>
                        <x-input-label for="vendor_id" value="Vendor" />
                        <select x-model="vendor_id" id="vendor_id"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-main focus:border-main block w-full p-2.5 transition-all duration-200"
                            x-bind:class="errors.vendor_id ? '!border-red-500' : ''">
                            <option value="">Pilih Vendor</option>
                            <template x-for="v in allVendors" :key="v.id">
                                <option :value="v.id" x-text="v.nama_perusahaan"></option>
                            </template>
                        </select>
                        <x-field-error name="vendor_id" />
                    </div>
                    <div>
                        <x-input-label for="kartu_id" value="SIM Card" />
                        <select x-model="kartu_id" id="kartu_id"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-main focus:border-main block w-full p-2.5 transition-all duration-200"
                            x-bind:class="errors.kartu_id ? '!border-red-500' : ''">
                            <option value="">Pilih SIM Card</option>
                            <template x-for="k in allKartu" :key="k.id">
                                <option :value="k.id" x-text="k.nomor"></option>
                            </template>
                        </select>
                        <x-field-error name="kartu_id" />
                    </div>
                    <div>
                        <x-input-label for="latitude" value="Latitude" />
                        <x-text-input x-model="latitude" id="latitude" class="w-full" placeholder="-8.4095" x-bind:class="errors.latitude ? '!border-red-500' : ''" />
                        <x-field-error name="latitude" />
                    </div>
                    <div>
                        <x-input-label for="longitude" value="Longitude" />
                        <x-text-input x-model="longitude" id="longitude" class="w-full" placeholder="115.1889" x-bind:class="errors.longitude ? '!border-red-500' : ''" />
                        <x-field-error name="longitude" />
                    </div>
                    <div>
                        <x-input-label for="auth_user" value="Auth User CCTV" />
                        <x-text-input x-model="auth_user" id="auth_user" class="w-full" placeholder="admin" x-bind:class="errors.auth_user ? '!border-red-500' : ''" />
                        <x-field-error name="auth_user" />
                    </div>
                    <div>
                        <x-input-label for="auth_password" value="Auth Password CCTV" />
                        <x-text-input type="password" x-model="auth_password" id="auth_password" class="w-full" placeholder="******" x-bind:class="errors.auth_password ? '!border-red-500' : ''" />
                        <x-field-error name="auth_password" />
                    </div>
                </div>
                <div class="flex justify-end mt-8 space-x-3">
                    <a href="/camera"
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
            this.errors = {};
            const metaTag = document.head.querySelector('meta[name="csrf-token"]');
            const postData = {
                ip: this.ip,
                mac: this.mac || null,
                resolusi: this.resolusi || null,
                auth_user: this.auth_user,
                auth_password: this.auth_password,
                channel: this.channel,
                tipe: this.tipe || null,
                brand: this.brand || null,
                latitude: this.latitude || null,
                longitude: this.longitude || null,
                vendor_id: this.vendor_id == '' ? null : this.vendor_id,
                kartu_id: this.kartu_id == '' ? null : this.kartu_id,
            };
            let headers = {
                'X-CSRF-Token': metaTag.getAttribute('content')
            }
            axios.post("/api/camera", postData, headers).then(function(response) {
                Swal.fire({
                    title: "Berhasil !",
                    icon: "success",
                    timer: 1500,
                });
                setTimeout(() => {
                    window.location.href = "/camera"
                }, 1000);
            }).catch((error) => {
                applyFormErrors(this, error);
            });
        }
    </script>
@endsection
