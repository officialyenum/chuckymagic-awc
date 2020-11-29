@extends('layouts.admin')
@section('title')
    {{ isset($post) ? 'Edit Post' : 'Create Post'}} List
@endsection
@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h1>
                {{ isset($post) ?'Edit Post':'Create Post' }}
            </h1>
        </div>
        <div class="card-body  mb-5">
        @include('partials.errors')
        <form action="{{ isset($post) ? route('posts.update',$post->slug) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($post))
                    @method('PUT')
                @endif
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ isset($post) ? $post->title : ''}}">
            </div>
            <div class="form-group">
                <label for="image">Header Image</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ isset($post) ? $post->description : ''}}</textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="summernote"></textarea>
                {{--@trix(\App\Post::class, 'content')--}}
                {{-- <label for="content">Content</label>
                <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : ''}}">
                <trix-editor input="content"></trix-editor> --}}
            </div>
            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="text" class="form-control" name="published_at" id="published_at" value="{{ isset($post) ? $post->published_at : ''}}">
            </div>
            <div class="form-group">
                <label for="event_day">Event Day</label>
                <input type="text" class="form-control" name="event_day" id="event_day" value="{{ isset($post) ? $post->event_day : ''}}">
            </div>
            @if (isset($post))
                <div class="form-group">
                <img src="{{ asset($post->image)}}" alt="image" width="100%">
                </div>

            @endif
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    @if (isset($categories))
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @if(isset($post))
                                    @if($category->id == $post->category_id)
                                        selected
                                    @endif
                                @endif
                                >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            @if (isset($tags))
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
                                >
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    {{ isset($post) ? 'Update Post' : 'Add Post' }}
                </button>
            </div>
        </form>

        </div>
    </div>
@endsection

@section('scripts')
    <!-- include summernote /js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true,
            enableSeconds: true
        })


        flatpickr('#event_day', {
            enableTime: true,
            enableSeconds: true
        })

        $(document).ready(function() {
            $('.tags-selector').select2();
            $('#summernote').summernote({
                placeholder: 'Content goes here...',
                height: 200,
                dialogsInBody: true,
                callbacks:{
                onInit:function(){
                    $('body > .note-popover').hide();
                }
             },
            });

        })
    </script>

@endsection

@section('css')
    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection
