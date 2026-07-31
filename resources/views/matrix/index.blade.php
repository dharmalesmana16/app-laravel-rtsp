@extends('template.index')
@section('content')
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div id="stream-grid" data-poll-ms="5000">
            @include('matrix._items', ['groups' => $groups])
        </div>
    </div>

    <x-modal-view-streaming />
@endsection
