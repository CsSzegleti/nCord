@extends('layouts.main')

@section('content')
<h1 class="display-1">{{ $torrent->name }}</h1>
<p>{{ $torrent->uploader->name }} | {{ $torrent->updated_at->diffForHumans() }} | {{ $avgRating }}/5 </p>
<div>{{__ ('Category')}} : {{ $torrent->category->name }}</div>
<div>{ !!$torrent->description !!}</div>
<form action="{{ route('torrent.rate', $torrent) }}" method="POST">
  <label for="rating">{{ __('Rate the content')}}</label>
  <input type="number" name="rating" min="1" max="5">
  <button class="btn btn-primary btn-lg">{{__('Rate')}}</button>
</form>
@endsection