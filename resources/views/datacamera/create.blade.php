@extends('template.index')
@section('content')
    <div class="mx-auto container pt-20">
        <div class="bg-white rounded-3xl shadow-md p-5 mb-5">
            <form action="" x-data="{
                ip: '',
                mac: '',
                gateway: '',
                dns: '',
                auth_user: '',
                auth_password: '',
                tipe: '',
                brand: '',
                id_vendor: '',
                id_kartu: '',
                channel: '',
            
            }">
                <div class="mb-3">
                    <label for="ip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        IP Camera
                    </label>
                    <x-text-input id="ip" class="" x-model="ip"></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="mac" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Alamat MAC
                    </label>
                    <x-text-input x-model="mac" id="mac" class=""></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="gateway" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Alamat Gateway
                    </label>
                    <x-text-input x-model="gateway" id="gateway" class=""></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="dns" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Alamat DNS
                    </label>
                    <x-text-input x-model="dns" id="dns" class=""></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="channel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Channel
                    </label>
                    <x-text-input x-model="channel" id="channel" class=""></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="auth_user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Auth User CCTV
                    </label>
                    <x-text-input x-model="auth_user" id="auth_user" class=""></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="auth_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Auth Password CCTV
                    </label>
                    <x-text-input tipe="password" x-model="auth_password" id="auth_password" class=""></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Tipe CCTV
                    </label>
                    <x-text-input x-model="tipe" id="tipe" class=""></x-text-input>

                </div>


                <div class="text-right">
                    <button type="submit" x-on:click.prevent="onCreate"
                        class="text-right text-white bg-gradient-to-r 
    from-lime-200 via-lime-400 to-lime-500 
    hover:bg-gradient-to-br focus:ring-4 
    focus:outline-none focus:ring-lime-300 
    dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-4 py-2 text-center  mb-2">
                        Tambah Data
                    </button>
                </div>
            </form>

        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            $.ajax({

                type: "get",
                url: "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
                data: "data",
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    let optionsHtml;
                    $.each(response, function(index, item) {
                        optionsHtml += '<option value="' + item.id + '">' + item.name +
                            '</option>';
                    });
                    $('.data_provinsi').html(optionsHtml);

                }
            });

            $('.data_provinsi').change(function(e) {
                e.preventDefault();
                var selectedLabel = $(this).find('option:selected').text();
                // console.log(selectedLabel)
                $.ajax({
                    type: "get",
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${e.target.value}.json`,
                    data: "data",
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        let optionsHtml;
                        $.each(response, function(index, item) {
                            optionsHtml += '<option value="' + item.id + '">' + item
                                .name +
                                '</option>';
                        });
                        $('.data_kabupaten').html(optionsHtml);

                    }
                });
            });
            $('.data_kabupaten').change(function(e) {
                e.preventDefault();
                var selectedLabel = $(this).find('option:selected').text();
                $.ajax({
                    type: "get",
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${e.target.value}.json`,
                    data: "data",
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        let optionsHtml;
                        $.each(response, function(index, item) {
                            optionsHtml += '<option value="' + item.id + '">' + item
                                .name +
                                '</option>';
                        });
                        $('.data_kecamatan').html(optionsHtml);

                    }
                });
            });
        })

        function onCreate(e) {
            e.preventDefault()
            const metaTag = document.head.querySelector('meta[name="csrf-token"]');
            const postData = {
                ip: this.ip,
                mac: this.mac,
                gateway: this.gateway,
                dns: this.dns,
                auth_user: this.auth_user,
                channel: this.channel,
                auth_password: this.auth_password,
                tipe: this.tipe,
                id_vendor: this.id_vendor == '' ? null : this.id_vendor,
                id_kartu: this.id_kartu == '' ? null : this.id_kartu,
            };
            let headers = {
                // "Content-Type": "application/json",
                'X-CSRF-Token': metaTag.getAttribute('content')
            }
            // console.log(metaTag.getAttribute('content'))
            // console.log(this.harga_beli)
            axios.post("/api/camera", postData, headers).then(function(response) {

                Swal.fire({
                    title: "Berhasil !",
                    icon: "success",
                    timer: 1500,

                });
                setTimeout(() => {
                    window.location.href = "/camera"
                }, 1000);
            });
            // fetch('/api/barang', {
            //         method: 'POST', // Specify the method
            //         headers: {
            //             "Content-Type": "application/json",
            //             'X-CSRF-Token': metaTag.getAttribute('content')
            //         },
            //         body: JSON.stringify(postData) // Convert the JavaScript object to a JSON string
            //     })
            //     .then(response => console.log(response)) // Parse the JSON response from the server
            //     .then(data => console.log(data)) // Handle the response data
            //     .catch(error => console.error('Error:', error)); // Handle any errors
        }
    </script>
@endsection
