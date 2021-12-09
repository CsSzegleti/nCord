@extends('layouts.main')

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => { console.log(editor) })
        .catch(error => { console.error(error) })
</script>
@endpush

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="display-4">{{ __('Upload') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('torrent.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <x-form.input name="name" label="{{ __('Name') }}" />
                    </div>
                    <div class="mb-3">
                        <label for="torrentfile">{{ __('Upload torrent file') }}</label>
                        <input class="form-control" type="file" name="filename">
                    </div>
                    <div class="mb-3">
                        <label for="category_id">{{ __('Category') }}</label>
                        <select name="category_id" class="form-control">
                            <option>{{ __('Please choose a category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        
                        <textarea id="editor" name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-lg">{{ __('Upload') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-body">
            <div class="alert alert-info mb-0">
                {{ __('Save torrent in order to add images') }}
            </div>
        </div>
    </div>
</div>

@endsection