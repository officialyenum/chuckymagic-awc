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
                                    @include('modal.editPost')
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

<!-- Modal -->
@include('modal.user')



@endsection
@section('third_party_scripts')


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> --}}
    <script>
        $(function () {

            $('#postTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            bsCustomFileInput.init();
            $('.summernote').summernote({
                tabsize: 2,
                height: 300
            });
            //Date range picker
            $('.datepicker').datetimepicker({
                format: "yyyy-MM-dd HH:mm:ss"
            });
            $('.tags-selector').select2()
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
        var btn = document.getElementById('postButton');
        btn.onclick = function process() {
            var form = document.getElementById('createPostForm');
            form.style.display = 'none';
            var processing = document.createElement('span');
            // processing.appendChild(image);
            processing.appendChild(document.createTextNode('processing ...'));
            form.parentNode.insertBefore(processing, form);
            $("#overlay, #PleaseWaitCreate").show();
        }
        // function createPost(formId) {
        //     var form = document.getElementById(formId)
        //     console.log(form);
        //     form.style.display = 'none';
        //     var processing = document.createElement('span');
        //     processing.appendChild(image);
        //     processing.appendChild(document.createTextNode('processing ...'));
        //     form.parentNode.insertBefore(processing, form);
        //     form.submit();
        //     $("#overlay, #PleaseWaitCreate").show();
        // }

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
