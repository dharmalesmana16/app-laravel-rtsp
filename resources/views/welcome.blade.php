@extends('template.index')
@vite(['resources/js/home.js'])

@section('content')
    <section class=" bg-white  shadow-md ">

        <div class="">

            <div id="map" class="" style="height: 1000px"></div>
        </div>

    </section>
    <div style="display: none">
        <canvas id="chanel0" width="50" height="50" style="width:300px"></canvas>
        <canvas id="chanel1" width="50" height="50" style="width:300px"></canvas>
    </div>
    <script src="/js/jsmpeg.min.js"></script>
    <script type="text/javascript">
        var canvas = document.getElementById('chanel1');
    </script>
@endsection
