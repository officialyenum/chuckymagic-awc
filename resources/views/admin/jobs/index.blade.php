@extends('layouts.administrator')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#createJob">
            Create Job
        </button>
        {{-- <a href="{{ route('jobs.create')}}" class="btn btn-success float-right my-2">Add Job </a> --}}
    </div>
    <div class="card card-default">
        <div class="card-header">
            Jobs
        </div>
        <div class="card-body">
            @if ($jobs->count() > 0)
            <table id="jobTable" class="table table-bordered table-striped">
                    <thead>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Users</th>
                        <th>Description</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr>
                                <td>
                                    {{ $job->id }}
                                </td>
                                <td>
                                    {{ $job->name }}
                                </td>
                                <td>
                                    {{ $job->users->count() }}
                                </td>
                                <td>
                                    {{ $job->description }}
                                </td>
                                <td class="text-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editJob-{{$job->id}}">
                                        <i class="ri-pencil-line"></i>Edit
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger float-right ml-1" onclick="handleDelete({{ $job->id }})">Delete</button>
                                </td>
                            </tr>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editJob-{{ $job->id }}" tabindex="-1" role="dialog" aria-labelledby="editJobLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Post Type</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                @include('partials.errors')
                                                <form action="{{ route('jobs.update',$job->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" name="name" value="{{ $job->name}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ $job->description}}</textarea>
                                                            {{-- <input type="text" class="form-control" name="description" value="{{ $job->description}}"> --}}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Update Job</button>
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
                    <form action="" method="POST" id="deleteJobForm">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Delete Job</h5>
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
                <h3 class="text-center">No Jobs Yet</h3>
            @endif
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="createJob" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="createJobLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Job</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @include('partials.errors')
                        <form action="{{ route('jobs.store')}}" method="POST">
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
                            <button type="submit" class="btn btn-success">Add Job</button>
                        </div>
                        </form>
            </div>
        </div>
    </div>
@endsection

@section('third_party_scripts')
<script>
    $(function () {
        $('#jobTable').DataTable({
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
            var form = document.getElementById('deleteJobForm')
            form.action = '/jobs/' + id
            console.log('deleting', form);

            $('#deleteModal').modal('show')
        }
    </script>

@endsection
