<!--Edit Modal -->
<div class="modal fade" id="editPost-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="editPostLabel" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Edit Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

            <div id='pleaseWaitEdit-{{$post->id}}' class="text-center" style="display: none"><img class="m-auto" src='https://media.giphy.com/media/feN0YJbVs0fwA/giphy.gif'/></div>
            <form id="editPostForm-{{ $post->id }}" action="{{ route('posts.update',$post->slug) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="container-fluid">
                            <div class="form-group">
                                <label for="title-{{$post->id}}">Title</label>
                                <input type="text" class="form-control" name="title" id="title-{{$post->id}}" value="{{ $post->title}}" oninput="enableButton('editPostButton-{{ $post->id }}')">
                            </div>

                            {{-- <div class="form-group">
                                <label for="image">Header Image</label>
                                <input type="file" class="custom-file-input form-control" name="image" id="image-{{$post->id}}">

                            </div> --}}
                            <label for="image-{{$post->id}}">Header Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="image-{{$post->id}}"  oninput="enableButton('editPostButton-{{ $post->id }}')">
                                <label class="custom-file-label" for="image">"{{ $post->image}}"</label>
                            </div>
                            <div class="form-group">
                                <img src="{{ $post->imageUrl }}" alt="image" width="100%">
                            </div>
                            <div class="form-group my-2">
                                <label for="description">Description</label>
                                <textarea name="description" id="description-{{$post->id}}" cols="5" rows="5" class="form-control"  oninput="enableButton('editPostButton-{{ $post->id }}')">{{ $post->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="content-{{$post->id}}">Content</label>
                                <textarea name="content" class="summernote"  oninput="enableButton('editPostButton-{{ $post->id }}')">{!! $post->content !!}</textarea>
                                {{--@trix(\App\Post::class, 'content')--}}
                                {{-- <label for="content">Content</label>
                                <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : ''}}">
                                <trix-editor input="content"></trix-editor> --}}
                            </div>
                            <div class="form-group">
                                <label for="published-{{$post->id}}">Published At</label>
                                <div class="input-group date" id="published-{{$post->id}}" data-target-input="nearest">
                                    <input type="datetime" class="form-control datetimepicker-input" data-target="#published-{{$post->id}}"  name="published_at" value="{{ $post->published_at}}"  oninput="enableButton('editPostButton-{{ $post->id }}')"/>
                                    <div class="input-group-append" data-target="#published-{{$post->id}}" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="event-{{$post->id}}">Event Day</label>
                                <div class="input-group date" id="event-{{$post->id}}" data-target-input="nearest">
                                    <input type="datetime" class="form-control datetimepicker-input" data-target="#event-{{$post->id}}" name="event_day" value="{{ $post->event_day }}"  oninput="enableButton('editPostButton-{{ $post->id }}')"/>
                                    <div class="input-group-append" data-target="#event-{{$post->id}}" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category-{{$post->id}}" class="form-control"  onchange="enableButton('editPostButton-{{ $post->id }}')">
                                    @if (isset($categories))
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if($category->id == $post->category_id)
                                                    selected
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
                                    <select name="tags[]" id="tags-{{$post->id}}" class="form-control tags-selector" multiple="multiple" data-placeholder="Select Features" style="width: 100%;" onchange="enableButton('editPostButton-{{ $post->id }}')">
                                        @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            @if ($post->hasTag($tag->id))
                                                selected
                                            @endif
                                            >
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                                @endif
                            @endif
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="editPostButton-{{ $post->id }}" disabled type="button" class="btn btn-success" onclick="updatePost('editPostForm-{{ $post->id }}', 'pleaseWaitEdit-{{$post->id}}')">Update Post</button>
                </div>
                <div class="lock-modal"></div>
                <div class="loading-circle"></div>
            </form>
        </div>
    </div>
</div>
