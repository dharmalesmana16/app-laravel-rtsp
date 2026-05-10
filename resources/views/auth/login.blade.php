<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section class="bg-main-400">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            {{-- <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white"> --}}
            <div class="">

                <img class="w-42 h-24 text-center mx-auto" src="/images/logo-bdr.png" alt="logo">

            </div>

            {{-- </a> --}}
            <div id="login-alert" class=" hidden p-4 mb-4 text-sm rounded-lg w-full sm:max-w-md" role="alert">
                <span class="font-medium content-alert"></span>
            </div>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-second-500 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-lg font-bold  text-center leading-tight tracking-tight text-gray-900 md:text-lg dark:text-gray-900">
                        Aplikasi Inventaris Barang
                    </h1>
                    <form x-data="{ username: '', password: '' }" class="space-y-4 md:space-y-6 formAuth" action="/signin"
                        method="post" @submit.prevent="submitForm">
                        @method('post')
                        @csrf
                        <div>
                            <label for="username"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Username</label>
                            <input type="username" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-main-600 focus:border-main-600 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-200 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="" x-model="username">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-main-600 focus:border-main-600 block w-full p-2.5 dark:bg-gray-50 dark:border-gray-200 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="" x-model="password">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">

                            </div>
                            {{-- <a href="#"
                                class="text-sm font-medium text-main-600 hover:underline dark:text-main-500">Forgot
                                password?</a> --}}
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-main-600 hover:bg-main-700 focus:ring-4 focus:outline-none focus:ring-main-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-main-600 dark:hover:bg-main-700 dark:focus:ring-main-800">Sign
                            in</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
{{-- <script src="/js/particles.min.js"></script>
<script src="/js/particles.js"></script>
<script src="/js/app.js"></script> --}}
<script>
    function submitForm() {
        // e.preventDefault();
        const metaTag = document.head.querySelector('meta[name="csrf-token"]');
        let postData = {
            "username": this.username,
            "password": this.password
        }
        let headers = {
            // "Content-Type": "application/json",
            'X-CSRF-Token': metaTag.getAttribute('content')
        }
        axios.post('/signin', postData, headers).then(function(response) {
            if (response.data.code == 1) {
                console.log("Sukses")
                window.location.replace("/")
            } else {
                console.log("Gagal")
            }
        })
    } // document.addEventListener("alpine:init")
    // $('.formAuth').submit(function(e) {
    //     e.preventDefault();
    //     $.ajax({
    //         type: "post",
    //         url: "/signin",
    //         data: $(this).serialize(),
    //         dataType: "json",
    //         success: function(response) {
    //             // console.log(response)
    //             if (response.code == "1") {
    //                 $('#login-alert').addClass(
    //                     "text-green-800  bg-green-50 dark:bg-gray-800 dark:text-green-400")
    //                 $("#login-alert").html(response.msg).fadeIn('slow');
    //                 // $('.content-alert').text("Berhasil !")
    //                 // $(".loginAlert").hide().html(response.msg).fadeIn('slow');

    //                 // $('.loginAlert').attr('class', 'alert alert-success loginAlert text-center');
    //                 setTimeout(function() {
    //                     window.location.replace('/');
    //                 }, 2000);
    //             } else {
    //                 // $(".loginAlert").hide().html(response.msg).fadeIn('slow');
    //                 $('#login-alert').addClass(
    //                     "text-red-800  bg-red-50 dark:bg-gray-800 dark:text-red-400")

    //                 $("#login-alert").text(response.msg).fadeIn('slow');
    //                 // $('.loginAlert').attr('class', 'alert alert-danger loginAlert text-center');
    //                 setTimeout(function() {
    //                     $('#login-alert').fadeOut();
    //                 }, 5000);
    //             }
    //         }
    //     });
    // });
</script>
