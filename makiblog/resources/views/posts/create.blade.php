@extends('layouts.app')
@section('content')
    <div class="card card-default border-primary">
        <div class="card-header text-primary">
            {{ isset($post) ? 'Uredi post' : 'Kreiraj novi post' }}
        </div>
        <div class="card-body">
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($post))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="title">Naziv</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ isset($post) ? $post->title : '' }}">
            </div>

                <div class="form-group">
                    <label for="content">Tekst</label>
                <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : "" }}">
                <trix-editor input="content"></trix-editor>
                </div>

                <div class="form-group">
                        <label for="category">Kategorija</label>
                        <select name="category" id="category" class="form-control">
                            @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                            @if (isset($post))
                            @if ($category->id == $post->category_id)
                            selected
                            @endif
                                
                            @endif  
                            >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($tags->count() > 0)
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                                @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                @if (isset($post))
                                @if ($post->hasTag($tag->id))
                                    selected
                                @endif
                                    
                                @endif
                                >{{ $tag->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    @endif
                    

                    @if (isset($post))
                    <div class="form-group">
                        <img style="width:100%" src="/storage/cover_images/{{$post->featured}}" alt="image">
                    </div>
                    @endif

                <div class="form-group">
                        <label for="featured">Fotografija</label>
                        <input type="file" name="featured" id="featured" class="form-control">
                    </div>


                <div class="form-group">
                    <div class="text-center">
                    <button class="btn btn-primary" type="submit">{{ isset($post) ? 'Uredi' : 'Kreiraj' }}</button>
                    </div>
                </div>
        </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.tags-selector').select2();
    });


</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection
