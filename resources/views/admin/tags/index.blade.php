@extends('layouts.administrator')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#createTag">
            Create Tag
        </button>
        {{-- <a href="{{ route('tags.create')}}" class="btn btn-success float-right my-2">Add Tag </a> --}}
    </div>
    <div class="card card-default">
        <div class="card-header">
            Tags
        </div>
        <div class="card-body">
            @if ($tags->count() > 0)
            <table id="tagTable" class="table table-bordered table-striped">
                    <thead>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Posts Count</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>
                                    {{ $tag->id }}
                                </td>
                                <td>
                                    {{ $tag->name }}
                                </td>
                                <td>
                                    {{ $tag->posts->count() }}
                                </td>
                                <td class="text-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editTag-{{$tag->id}}">
                                        <i class="ri-pencil-line"></i>Edit
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger float-right ml-1" onclick="handleDelete({{ $tag->id }})">Delete</button>
                                </td>
                            </tr>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editTag-{{ $tag->id }}" tabindex="-1" role="dialog" aria-labelledby="editTagLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Tag</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                @include('partials.errors')
                                                <form action="{{ route('tags.update',$tag->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" name="name" value="{{ $tag->name}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ $tag->description}}</textarea>
                                                            {{-- <input type="text" class="form-control" name="description" value="{{ $tag->description}}"> --}}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Update Tag</button>
                                                    </div>
                                                </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

                <div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <form action="" method="POST" id="deleteTagForm">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Delete Tag</h5>
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
            @else
                <h3 class="text-center">No Tags Yet</h3>
            @endif
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="createTag" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="createTagLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Tag</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @include('partials.errors')
                        <form action="{{ route('tags.store')}}" method="POST">
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
                            <button type="submit" class="btn btn-success">Add Tag</button>
                        </div>
                        </form>
            </div>
        </div>
    </div>
@endsection

@section('third_party_scripts')
<script>
    $(function () {
        $('#tagTable').DataTable({
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
            var form = document.getElementById('deleteTagForm')
            form.action = '/tags/' + id
            console.log('deleting', form);

            $('#deleteModal').modal('show')
        }
    </script>

@endsection
