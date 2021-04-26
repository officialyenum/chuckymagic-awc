<!--Create Post Modal -->
<div class="modal fade" id="createPost" data-toggle="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="createPostLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Create Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

            <div id='PleaseWaitCreate' class="text-center" style="display: none"><img class="m-auto" src='https://media.giphy.com/media/feN0YJbVs0fwA/giphy.gif'/></div>
            {{-- @include('partials.errors') --}}
            <form id="createPostForm" action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="">
                        </div>
                        <label for="image">Header Image</label>
                        {{-- <div class="form-group">
                            <label for="image">Header Image</label>
                            <input type="file" class="custom-file-input form-control" name="image" id="image">

                        </div> --}}
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image" value="">
                            <label class="custom-file-label" for="image"></label>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" class="summernote"></textarea>
                            {{-- @trix(\App\Post::class, 'content') --}}
                            {{-- <label for="content">Content</label> --}}
                            {{-- <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : ''}}"> --}}
                            {{-- <trix-editor input="content"></trix-editor> --}}
                        </div>
                        {{-- <div class="form-group">
                            <label for="published_at">Published At</label>
                            <input type="text" class="form-control datetimepicker-input" name="published_at" id="published_at" value="">
                        </div> --}}
                        <div class="form-group">
                            <label for="published_at">Published At</label>
                            <div class="input-group date" id="published_at" data-target-input="nearest">
                                <input type="datetime" class="form-control datepicker datetimepicker-input" data-target="#published_at"  name="published_at" value=""/>
                                <div class="input-group-append" data-target="#published_at" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="event_day">Event Day</label>
                            <input type="text" class="form-control" name="event_day" id="event_day" value="{{ isset($post) ? $post->event_day : ''}}">
                        </div> --}}
                        <div class="form-group">
                            <label for="event_day">Event Day</label>
                            <div class="input-group date" id="event_day" data-target-input="nearest">
                                <input type="datetime" class="form-control datepicker datetimepicker-input" data-target="#event_day" name="event_day" value=""/>
                                <div class="input-group-append" data-target="#event_day" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" selected>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if ($tags->count() > 0)
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <select name="tags[]" id="tags" class="form-control tags-selector" multiple="multiple" data-placeholder="Select Tags" style="width: 100%;">
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
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button id="postButton" type="submit" class="btn btn-success">Add Post</button>
                </div>
                <div class="lock-modal"></div>
                <div class="loading-circle"></div>
            </form>
        </div>
    </div>
</div>


{{-- Delete Post Modal--}}
<div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form action="" method="POST" id="deletePostForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <p class="text-center text-bold">
                        Are you sure you want to delete ?
                    </p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">No, Go Back</button>
                <button type="submit" class="btn btn-danger">Yes Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
