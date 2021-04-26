@extends('layouts.administrator')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#createSkill">
            Create Skill
        </button>
        {{-- <a href="{{ route('skills.create')}}" class="btn btn-success float-right my-2">Add Skill </a> --}}
    </div>
    <div class="card card-default">
        <div class="card-header">
            Skill
        </div>
        <div class="card-body">
            @if ($skills->count() > 0)
            <table id="skillTable" class="table table-bordered table-striped">
                    <thead>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Users</th>
                        <th>Description</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($skills as $skill)
                            <tr>
                                <td>
                                    {{ $skill->id }}
                                </td>
                                <td>
                                    {{ $skill->name }}
                                </td>
                                <td>
                                    {{ $skill->users->count() }}
                                </td>
                                <td>
                                    {{ $skill->description }}
                                </td>
                                <td class="text-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editSkill-{{$skill->id}}">
                                        <i class="ri-pencil-line"></i>Edit
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger float-right ml-1" onclick="handleDelete({{ $skill->id }})">Delete</button>
                                </td>
                            </tr>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editSkill-{{ $skill->id }}" tabindex="-1" role="dialog" aria-labelledby="editSkillLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Skill</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                @include('partials.errors')
                                                <form action="{{ route('skills.update',$skill->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" name="name" value="{{ $skill->name}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ $skill->description}}</textarea>
                                                            {{-- <input type="text" class="form-control" name="description" value="{{ $skill->description}}"> --}}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Update Skill</button>
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
                    <form action="" method="POST" id="deleteSkillForm">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Delete Skill</h5>
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
                <h3 class="text-center">No Skills Yet</h3>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createSkill" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="createSkillLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Skill</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @include('partials.errors')
                        <form action="{{ route('skills.store')}}" method="POST">
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
                            <button type="submit" class="btn btn-success">Add Skill</button>
                        </div>
                        </form>
            </div>
        </div>
    </div>
@endsection

@section('third_party_scripts')
<script>
    $(function () {
        $('#skillTable').DataTable({
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
            var form = document.getElementById('deleteSkillForm')
            form.action = '/skills/' + id
            console.log('deleting', form);

            $('#deleteModal').modal('show')
        }
    </script>

@endsection
