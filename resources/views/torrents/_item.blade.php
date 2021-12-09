<div class="d-flex text-muted pt-3">
    <img class="bd-placeholder-img flex-shrink-0 me-2 rounded" src="https://via.placeholder.com/64" width="64" height="64" alt="{{ $torrent->name }}">
    <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark">
            <a href="{{ route('category.details', $torrent->category) }}">{{ $torrent->category->name }}</a> - 
            <a href="{{ route('torrent.details', $torrent) }}">{{ $torrent->name }}</a>
        </strong>
        {{ __('Uploaded by:')}}
        @auth
            <a href="{{ route('user.details', $torrent->uploader)}}">
            <img class="rounded-circle" src="{{ $torrent->uploader->avatar }}" width="20" alt="{{ $torrent->uploader->name }}" />
            {{ $torrent->uploader->name }}</a> | {{$torrent->created_at->diffForHumans()}}
        @else
            <a class="disabled" href="">
            <img class="rounded-circle disa" src="{{ $torrent->uploader->avatar }}" width="20" alt="{{ $torrent->uploader->name }}" />
            {{ $torrent->uploader->name }}</a> | {{$torrent->created_at->diffForHumans()}}
        @endauth
    </p>
</div>