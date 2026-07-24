@extends('template.index')
@section('content')
    <div class="">
        <div class="bg-white rounded-3xl shadow-md p-5 mb-5">
            <form action="" x-data="{
                nama_perusahaan: '',
                pic: '',
                alamat: '',
                cp: '',
                provinsi: '',
                tgl_beli: '',
                kota: '',
                kode_pos: '',
                kecamatan: '',
                email_perusahaan: '',
            
            }">
                <div class="mb-3">
                    <label for="nama_perusahaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Perusahaan
                    </label>
                    <x-text-input id="nama_perusahaan" class="" x-model="nama_perusahaan"></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="pic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama PIC
                    </label>
                    <x-text-input x-model="pic" id="pic" class=""></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="cp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nomor Telephone / Whatsapp
                    </label>
                    <x-text-input x-model="cp" id="cp" class=""></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="email_perusahaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email
                    </label>
                    <x-text-input x-model="email_perusahaan" id="email_perusahaan" class=""></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Alamat
                    </label>
                    <x-text-input x-model="alamat" id="alamat" class=""></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="kode_pos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Kode Pos
                    </label>
                    <x-text-input x-model="kode_pos" id="kode_pos" class=""></x-text-input>

                </div>
                <div class="mb-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Provinsi
                    </label>
                    <select name="" id="" x-model="provinsi"
                        class="data_provinsi bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                        <option class="" value=""></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Kota / Kabupaten
                    </label>
                    <select name="" id="" x-model="kota"
                        class="data_kabupaten bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option class="" value=""></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Kecamatan
                    </label>
                    <select name="" id="" x-model="kecamatan"
                        class="data_kecamatan bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option class="" value=""></option>
                    </select>
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
                nama_perusahaan: this.nama_perusahaan,
                pic: this.pic,
                alamat: this.alamat,
                cp: this.cp,
                email: this.email,
                provinsi: this.provinsi,
                kecamatan: this.kecamatan,
                kota: this.kota,
                kode_pos: this.kode_pos,
                email_perusahaan: this.email_perusahaan
            };
            let headers = {
                // "Content-Type": "application/json",
                'X-CSRF-Token': metaTag.getAttribute('content')
            }
            // console.log(metaTag.getAttribute('content'))
            // console.log(this.harga_beli)
            axios.post("/api/vendor", postData, headers).then(function(response) {

                Swal.fire({
                    title: "Berhasil !",
                    icon: "success",
                    timer: 1500,

                });
                setTimeout(() => {
                    window.location.href = "/vendor"
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
