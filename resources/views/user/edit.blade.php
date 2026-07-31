@extends('template.index')
@section('content')
    <div class="px-4 py-6 mx-auto max-w-3xl sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="/user" class="inline-flex items-center text-sm text-gray-500 hover:text-main transition-colors">
                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Edit User</h2>
            <form x-data="{
                id: {{ request()->route('user') }},
                errors: {},
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                role: 'user',
                init() {
                    axios.get(`/api/user/${this.id}`).then(res => {
                        const d = res.data.data
                        this.name = d.name
                        this.email = d.email
                        this.role = d.role || 'user'
                    })
                }
            }">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-input-label for="name" value="Nama" />
                        <x-text-input id="name" class="w-full" x-model="name" x-bind:class="errors.name ? '!border-red-500' : ''" />
                        <x-field-error name="name" />
                    </div>
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input type="email" id="email" class="w-full" x-model="email" x-bind:class="errors.email ? '!border-red-500' : ''" />
                        <x-field-error name="email" />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="password" value="Password Baru (kosongi jika tidak diubah)" />
                            <x-text-input type="password" id="password" class="w-full" x-model="password" x-bind:class="errors.password ? '!border-red-500' : ''" />
                            <x-field-error name="password" />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                            <x-text-input type="password" id="password_confirmation" class="w-full" x-model="password_confirmation" x-bind:class="errors.password_confirmation ? '!border-red-500' : ''" />
                            <x-field-error name="password_confirmation" />
                        </div>
                    </div>
                    <div>
                        <x-input-label for="role" value="Role" />
                        <select x-model="role" id="role"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-main focus:border-main block w-full p-2.5 transition-all duration-200"
                            x-bind:class="errors.role ? '!border-red-500' : ''">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        <x-field-error name="role" />
                    </div>
                </div>
                <div class="flex justify-end mt-8 space-x-3">
                    <a href="/user"
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
            this.errors = {};
            if (this.password && this.password !== this.password_confirmation) {
                this.errors = {
                    password: ['Password tidak cocok dengan konfirmasi.'],
                    password_confirmation: ['Password tidak cocok dengan konfirmasi.'],
                };
                return
            }
            const metaTag = document.head.querySelector('meta[name="csrf-token"]');
            const postData = {
                name: this.name,
                email: this.email,
                password: this.password || undefined,
                role: this.role,
            };
            axios.put(`/api/user/${this.id}`, postData, {
                headers: { 'X-CSRF-Token': metaTag.getAttribute('content') }
            }).then(function(response) {
                Swal.fire({ title: "Berhasil !", icon: "success", timer: 1500 });
                setTimeout(() => window.location.href = "/user", 1000);
            }).catch((error) => {
                applyFormErrors(this, error);
            });
        }
    </script>
@endsection
