<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="/images/logo-jbt.png" type="image/x-icon" />
    <title> PLN Bali</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href=" https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css " rel="stylesheet">
    <script src="/js/jsmpeg.min.js"></script>

    {{-- <link href="{{ asset('/toggle/css/bootstrap4-toggle.min.css') }}" rel="stylesheet"> --}}
    {{-- <script src="/js/jquery.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/home.js'])
</head>

<body class="bg-gray-100">


    <nav class="bg-main">
        <div class="container px-4 py-3 mx-auto">
            <x-application-logo>
            </x-application-logo>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>

            <div class=" w-full  md:w-auto flex justify-between " id="navbar-default">

                <ul
                    class="font-medium flex flex-col   mt-0 p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-main md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 ">

                    <li>
                        <a href="/" class="flex  p-2 text-white rounded-lg hover:bg-second-500 group">
                            <svg class="shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="/stok"
                            class="flex  p-2 text-white rounded-lg hover:bg-gray-100 group">
                            <svg class="shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-gray-900"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 18">
                                <path
                                    d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">
                                Monitoring
                            </span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="/matrix" class="flex items-center p-2 text-white rounded-lg hover:bg-second-500 group">
                            <svg class="shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">
                                Matrix
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/vendor" class="flex items-center p-2 text-white rounded-lg hover:bg-second-500 group">
                            <svg class="shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">
                                Data Vendor
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/camera" class="flex items-center p-2 text-white rounded-lg hover:bg-second-500 group">
                            <svg class="shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">
                                Data CCTV
                            </span>
                        </a>
                    </li>


                </ul>
                <div class="">
                    <form action="signout" method="get">
                        <button
                            class="block px-4 py-2 text-sm text-white font-bold bg-red-600 rounded-xl  hover:bg-red-800 "
                            role="menuitem">
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- ========== header end ========== -->

    <div class=" mx-auto ">
        @yield('content')
    </div>
    <!-- ========== footer start =========== -->

    </main>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- <script src="https://jsdelivr.net"></script> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> --}}
    {{-- <script src="/toggle/js/bootstrap4-toggle.min.js"></script> --}}

    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="/js/sweetalert2/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
     <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script> --}}
    {{-- <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/dynamic-pie-chart.js"></script> --}}
    {{-- <script src="/js/main.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script> --}}
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=maps&v=weekly"></script> --}}
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script> -->
</body>

</html>
