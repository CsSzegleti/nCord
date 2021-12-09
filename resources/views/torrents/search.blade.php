@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <h6 class="border-bottom pb-2 mb-0">Search result</h6>
        @if ($torrents->isNotEmpty())
            @foreach($torrents as $torrent)
                @include('torrents._item')
            @endforeach
        </div>
        @else
        <div class="alert alert-warning">
            {{ __('Nothing to show') }}
        </div>
        @endif
    </div>

@endsection