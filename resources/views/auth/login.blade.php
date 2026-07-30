<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section class="bg-main-400">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="mb-6">
                <img class="w-42 h-24 mx-auto" src="/images/Logo_PLN.png" alt="logo">
            </div>

            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 w-full sm:max-w-md" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="w-full bg-white rounded-lg shadow sm:max-w-md p-6 space-y-4">
                <h1 class="text-lg font-bold text-center text-gray-900">
                    Sistem Monitoring Pekerjaan Vendor
                </h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-main-600 focus:border-main-600 block w-full p-2.5">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-main-600 focus:border-main-600 block w-full p-2.5">
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-main-600 hover:bg-main-700 focus:ring-4 focus:ring-main-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Sign in
                    </button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>
