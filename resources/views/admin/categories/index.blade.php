@extends('layouts.administrator')

@section('third_party_stylesheets')
    <!-- include summernote css -->
    <style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
    </style>
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
                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#createCategory">
                            Create Post Type
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Post Type</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="categoryTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <th>Name</th>
                                    <th>Post Count</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $category->id}}
                                        </td>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            {{ $category->posts->count() }}
                                        </td>
                                        <td class="text-center">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editCategory-{{$category->id}}">
                                                <i class="ri-pencil-line"></i>Edit
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-danger ml-1" onclick="handleDelete({{ $category->id }})">Delete</button>
                                        </td>
                                    </tr>

                                    <!--Edit Modal -->
                                    <div class="modal fade" id="editCategory-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Post Type</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        @include('partials.errors')
                                                        <form action="{{ route('categories.update',$category->id)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control" name="name" value="{{ $category->name}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="description">Description</label>
                                                                    <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ $category->description}}</textarea>
                                                                    {{-- <input type="text" class="form-control" name="description" value="{{ $tag->description}}"> --}}
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Update Post Type</button>
                                                            </div>
                                                        </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="row">ID</th>
                                    <th>Name</th>
                                    <th>Post Count</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
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
    <form action="" method="POST" id="deleteCategoryForm">
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
<div class="modal fade" id="createCategory" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="createCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    @include('partials.errors')
                    <form action="{{ route('categories.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Category</button>
                    </div>
                    </form>
        </div>
    </div>
</div>



@endsection

@section('third_party_scripts')
<script>
    $(function () {
        $('#categoryTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<script>
    function handleDelete(id) {
        var form = document.getElementById('deleteCategoryForm')
        form.action = '/categories/' + id
        console.log('deleting', form);

        $('#deleteModal').modal('show')
    }
</script>

@endsection
