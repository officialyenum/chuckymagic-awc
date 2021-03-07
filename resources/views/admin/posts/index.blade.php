@extends('layouts.administrator')

@section('third_party_stylesheets')
    <!-- include summernote css -->
    <style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet"/> --}}

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css"> --}}
@endsection
@section('content')
<!-- Start Contentbar -->
<div class="contentbar">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <div class="d-flex justify-content-end mb-2">
                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#createPost">
                            Create Post
                        </button>
                    </div>
                </div>
                {{-- @if(Session::has('success'))
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show alert-block" role="alert">
                        {{ Session::get("success") }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Post</h3>
                </div>
                <!-- /.card-header -->
                    <div class="card-body">
                        <table id="postTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <th>Photo</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>Posted By</th>
                                    <th>Date</th>
                                    <th>Edit/Restore</th>
                                    <th>Trash/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{$post->id}}</td>
                                        <td><img src="{{ $post->imageUrl }}" class="img-fluid" width="35" alt="post image"></td>
                                        <td>{{ $post->title }}</td>
                                        <td class="text-success">{{ $post->category->name}}</td>
                                        <td>
                                            @foreach ($post->tags as $tag)
                                            <span class="badge badge-secondary-inverse mr-2">{{$tag->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>{{$post->user->username}}</td>
                                        <td>{{$post->created_at->diffforhumans()}}</td>
                                        <div class="button-list">
                                            @if ($post->trashed())
                                            <div class="row align-items-center">
                                                <td>
                                                    <form action="{{route('restore-posts', $post->slug)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"  class="btn btn-success"><i class="ri-pencil-line"></i>Restore</button>
                                                    </form>
                                                </td>
                                                <td>
                                                <button class="btn btn-danger float-right ml-1" onclick="handleDelete({{ $post->slug }})" class="btn btn-danger-rgba"><i class="ri-delete-bin-3-line"></i>Delete</button>
                                                </td>
                                            </div>
                                            @else
                                                <div class="row align-items-center">
                                                    <td>
                                                        <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editPost-{{$post->id}}">
                                                            <i class="ri-pencil-line"></i>Edit
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('posts.destroy', $post->slug)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-3-line"></i>
                                                                Trash
                                                            </button>
                                                        </form>
                                                    </td>
                                                </div>
                                            @endif
                                        </div>
                                    </tr>
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
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="row">ID</th>
                                    <th>Photo</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>Posted By</th>
                                    <th>Date</th>
                                    <th>Edit/Restore</th>
                                    <th>Trash/Delete</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
<!-- End Contentbar -->


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

<!-- Modal -->
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
                                <select name="tags[]" id="tags" class="form-control tags-selector" multiple="multiple" data-placeholder="Select Features" style="width: 100%;">
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
                    <button type="button" class="btn btn-success" onclick="createPost('createPostForm')">Add Post</button>
                </div>
                <div class="lock-modal"></div>
                <div class="loading-circle"></div>
            </form>
        </div>
    </div>
</div>



@endsection
@section('third_party_scripts')

    <!-- include summernote /js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> --}}
    <script>
        $(function () {
            var errors = @json($errors->all());
            var message = "{{ session()->has('success') }}";
            console.log("{{ session()->has('success') }}");
            if (message) {
                Swal.fire({
                    icon: 'success',
                    title: "{{ session()->get('success') }}",
                    showConfirmButton: false,
                    timer: 3000
                })
            }
            console.log(message);
            if (errors.length > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: errors[0],
                    showConfirmButton: false,
                    timer: 4000
                })
            }
            bsCustomFileInput.init();
            $('.summernote').summernote({
                tabsize: 2,
                height: 300
            });
            //Date range picker
            $('.datepicker').datetimepicker({
                format: "yyyy-MM-dd HH:mm:ss"
            });
            $('.tags-selector').select2();

            $('#postTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('.custom-file-input').change(function() {
                var filename = $(this).val();
                var lastIndex = filename.lastIndexOf("\\");
                if (lastIndex >= 0) {
                    filename = filename.substring(lastIndex + 1);
                }
                $('.custom-file-label').val(filename);
            });
            //Initialize Select2 Elements
            // $('.tags-selector').select2({
            //     theme: 'bootstrap4'
            // })
        });
    </script>
    <script>
        function createPost(formId) {
            var form = document.getElementById(formId)
            console.log(form);
            form.style.display = 'none';
            var processing = document.createElement('span');
            processing.appendChild(image);
            processing.appendChild(document.createTextNode('processing ...'));
            form.parentNode.insertBefore(processing, form);
            form.submit();
            $("#overlay, #PleaseWaitCreate").show();
        }

        function updatePost(formId, pleaseWaitEdit) {
            console.log(formId);
            var form = document.getElementById(formId)
            console.log(form);
            form.style.display = 'none';
            var processing = document.createElement('span');
            processing.appendChild(image);
            processing.appendChild(document.createTextNode('processing ...'));
            form.parentNode.insertBefore(processing, form);
            form.submit();
            $(`#overlay, #${pleaseWaitEdit}`).show();
        }
        function enableButton(btnId) {
            console.log(btnId);
            document.getElementById(btnId).disabled = false;
        }
        function handleDelete(slug) {
            var form = document.getElementById('deletePostForm')
            form.action = 'posts/' + slug
            console.log('deleting', form);

            $('#deleteModal').modal('show')
        }

        /* function showPost(post) {
            var post = post
            console.log(post)
            $('#postModal').val( post ).modal('show')
        } */
    </script>
@endsection
