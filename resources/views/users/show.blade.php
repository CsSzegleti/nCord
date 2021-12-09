@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-2">
        <img class="flex-shrink-0 me-4 rounded" src="{{ $user->avatar }}" alt="{{ $user->name }}">
        <h6 class="display-6">{{ $user->name }}</h6>
        <div>
            <p>Uploaded torrents: {{ $user->uploads()->count() }}</p>
            <p>Rated torrents: {{ $user->ratings()->count() }}</p>
        </div>
    </div>
    <div class="col-lg-8">
        @forelse($torrents as $torrent)
            @include('torrents._item')
        @empty
            <div class="alert alert-warning">
                {{ __('No uploaded torrents') }}
            </div>
        @endforelse
        <div class="d-flex justify-content-center">
            {{ $torrents->links() }}
        </div>
    </div>
</div>
@endsection