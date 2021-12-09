@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css" integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => { console.log(editor) })
        .catch(error => { console.error(error) })

    Dropzone.autodiscover = false
    const myDropzone = new Dropzone('#image-upload', {
        headers: {
            'x-csrf-token': '{{ csrf_token() }}'
        },
        paramName: 'image',
        url: '{{ route("torrent.image", $torrent) }}',
    })
</script>    
@endpush

@section('content')
<form action="{{ route('torrent.edit', $torrent) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="display-4">{{ __('Edit') }} {{ $torrent->name}}</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <x-form.input name="name" label="{{ __('Name') }}" :value="$torrent->name"/>
                    </div>
                    <div class="mb-3">
                        <label for="category_id">{{ __('Category') }}</label>
                        <select name="category_id" class="form-control">
                            <option>{{ __('Please choose a category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $torrent->category_id ? 'selected' : ''}}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        
                        <textarea id="editor" name="description" class="form-control" rows="3" {{old('description', $torrent->description) }}></textarea>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-lg">{{ __('Upload') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-body">
                <div id="image-upload" class="dropzone"></div>
            </div>
        </div>
    </div>
</form>
@endsection