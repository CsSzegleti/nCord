@extends('layouts.main')

@section('content')
<h4 class="display-4">{{ $torrent->name }}</h1>
<p>{{ $torrent->uploader->name }} | {{ $torrent->updated_at->diffForHumans() }} | average rating: {{ $avgRating }}/5 </p>
<div>{{__('Category')}} : {{ $torrent->category->name }}</div>
<div>{!! $torrent->description !!}</div>
<div>
    @auth
        <a class="btn btn-primary btn-lg" href="/storage/{{ $torrent->filename }}" download>Download Torrent file</a>
    @else
        <a class="btn btn-primary btn-lg disabled" href="{{ route('auth.login') }}">Log in to download</a>
    @endauth
</div>

</div>
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">{{__('Ratings')}}</h6>
    <div>
        @auth    
            <form action="{{ route('torrent.rate', $torrent) }}" method="POST">
                @csrf
                <label class="form-label" for="rating">{{ __('Rate the content')}}</label>
                <input class="form-control" type="number" name="rating" min="1" max="5">
                <label class="form-label" for="message">{{ __('Rate the content')}}</label>
                <input class="form-control mb-3" type="textarea" name="message">
                <div class="d-grid">
                    <button class="btn btn-primary">{{__('Rate')}}</button>
                </div>
            </form>
        @endauth
    </div>
    @foreach ($torrent->ratings as $rating)
    <div class="d-flex text-muted pt-3">
        <img class="flex-shrink-0 me-4 rounded" width="32" height="32" src="{{ $torrent->uploader->avatar }}" alt="{{ $torrent->uploader->name }}">
        <p class="pb-3 mb-0 small lh-sm border-bottom">
          <strong class="d-block text-gray-dark">{{$rating->user->name}} | {{$rating->rating}}/5</strong>
          {{ $rating->message}}
        </p>
      </div>
    @endforeach
@endsection