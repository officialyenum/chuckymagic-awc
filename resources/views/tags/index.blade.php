@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('tags.create')}}" class="btn btn-success float-right my-2">Add Tag </a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Tags
        </div>
        <div class="card-body">
            @if ($tags->count() > 0)
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Posts Count</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>
                                    {{ $tag->name }}
                                </td>
                                <td>
                                    {{ $tag->posts->count() }}
                                </td>
                                <td>
                                    <button class="btn btn-danger float-right ml-1" onclick="handleDelete({{ $tag->id }})">Delete</button>
                                    <a href="{{ route('tags.edit', $tag->id)}}"  class="btn btn-primary float-right ml-1">Edit</a>
                                </td>
                            </tr>
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
@endsection

@section('scripts')

    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteTagForm')
            form.action = '/tags/' + id
            console.log('deleting', form);

            $('#deleteModal').modal('show')
        }
    </script>

@endsection
