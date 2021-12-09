@extends('layouts.main')

@section('content')
<div class="col-md-6 mx-auto">
    @if ($torrents->count())
    <div class="row">
            <h6 class="border-bottom pb-2 mb-0">{{ $category->name }}</h6>
                @foreach ($torrents as $torrent)
                    @include('torrents._item')
                @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $torrents->links() }}
        </div>
    @else
        <div class="alert alert-warning">
            {{ __('Nothing to show') }}
        </div>
    @endif
@endsection