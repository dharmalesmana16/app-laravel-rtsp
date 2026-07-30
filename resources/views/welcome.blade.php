@extends('template.index')
@vite(['resources/js/home.js'])

@section('content')
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white border border-gray-200 rounded-2xl shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-900">Peta Monitoring CCTV</h2>
                <p class="text-sm text-gray-500">Lokasi pemasangan camera CCTV</p>
            </div>
            <div id="map" class="w-full" style="height: 70vh;"></div>
        </div>
    </div>
    <div style="display: none">
        <canvas id="chanel0" width="50" height="50" style="width:300px"></canvas>
        <canvas id="chanel1" width="50" height="50" style="width:300px"></canvas>
    </div>
    <script src="/js/jsmpeg.min.js"></script>
    <script type="text/javascript">
        var canvas = document.getElementById('chanel1');
    </script>
@endsection
