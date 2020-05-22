@extends('layouts.admin')
@section('style')

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
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title mb-0">All Posts</h5>
                        </div>
                        <div class="col-6">
                            <ul class="list-inline-group text-right mb-0 pl-0">
                                <li class="list-inline-item">
                                      <div class="form-group mb-0 amount-spent-select">
                                        <select class="form-control" id="formControlSelect">
                                          <option>All</option>
                                          <option>Last Week</option>
                                          <option>Last Month</option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>Posted By</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <th scope="row">#{{$post->id}}</th>
                                        <td><img src="{{ $post->imageUrl }}" class="img-fluid" width="35" alt="post image"></td>
                                        <td>{{ $post->title }}</td>
                                        <td class="text-success">{{ $post->category->name}}</td>
                                        <td>
                                            @foreach ($post->tags as $tag)
                                            <span class="badge badge-secondary-inverse mr-2">{{$tag->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>{{$post->user->name}}</td>
                                        <td>{{$post->created_at->diffforhumans()}}</td>
                                        <td>
                                            <div class="button-list">
                                                @if ($post->trashed())
                                                    <form action="{{route('restore-posts', $post->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"  class="btn btn-success"><i class="ri-pencil-line"></i>Restore</button>
                                                    </form>
                                                    <button class="btn btn-danger float-right ml-1" onclick="handleDelete({{ $post->id }})" class="btn btn-danger-rgba"><i class="ri-delete-bin-3-line"></i>Delete</button>
                                                @else

                                                    <a href="{{ route('posts.edit', $post->id)}}" class="btn btn-success"><i class="ri-pencil-line"></i>Edit</a>
                                                    <form action="{{ route('posts.destroy', $post->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-3-line"></i>
                                                            Trash
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
<!-- End Contentbar -->


<div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
@endsection
@section('script')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deletePostForm')
            form.action = 'posts/' + id
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
