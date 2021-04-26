@extends('layouts.administrator')

@section('content')
    <div class="card card-header">
        <div class="card-header">
            <h2>Users</h2>
        </div>
        <div class="card-body">
            @if (auth()->user()->isSuperAdmin())
                @if ($users->count() > 0)
                    <div class="table-responsive">
                        <table id="userTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="row">#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Make</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        <img width="40px" height="40px" style="border-radius : 50%" src="{{ Gravatar::src($user->email)}}" alt="Avater">
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        @if ($user->role_id == 1)
                                            Super Admin
                                        @else
                                            @if ($user->role_id == 2)
                                                Admin
                                            @else
                                                @if ($user->role_id == 3)
                                                    Writer
                                                @else
                                                    Member
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                    @if ($user->isAdmin())
                                    <td>
                                        <form action="{{route('users.make-super-admin', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Make Super Admin</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{route('users.remove-admin', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Remove Admin</button>
                                        </form>
                                    </td>
                                    @endif
                                    @if ($user->isSuperAdmin())
                                        @if ($user->name == auth()->user()->name)
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        @else
                                            @if ($user->id == 10000001)
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                            @else
                                            <td>

                                            </td>
                                            <td>
                                                <form action="{{route('users.remove-super-admin', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove Super Admin</button>
                                                </form>
                                            </td>
                                            @endif
                                        @endif
                                    @endif
                                    @if ($user->isWriter())
                                    <td>
                                        <form action="{{route('users.make-admin', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{route('users.remove-writer', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Remove Writer</button>
                                        </form>
                                    </td>
                                    @endif
                                    @if ($user->isMember())
                                    <td>
                                        <form action="{{route('users.make-writer', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Make Writer</button>
                                        </form>
                                    </td>
                                    <td>

                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h3 class="text-center">No Users Yet</h3>
                @endif
            @else
                @if ($users->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="row">#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Make</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        <img width="40px" height="40px" style="border-radius : 50%" src="{{ Gravatar::src($user->email)}}" alt="Avater">
                                    </td>
                                    <td>
                                        {{ $user->username }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        @if ($user->role_id == 1)
                                            Super Admin
                                        @else
                                            @if ($user->role_id == 2)
                                                Admin
                                            @else
                                                @if ($user->role_id == 3)
                                                    Writer
                                                @else
                                                    User
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                    @if ($user->isAdmin())
                                    <td>

                                    </td>
                                    <td>
                                        <form action="{{route('users.remove-admin', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Remove Admin</button>
                                        </form>
                                    </td>
                                    @endif
                                    @if ($user->isSuperAdmin())
                                        @if ($user->username == auth()->user()->username)
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        @else
                                            @if ($user->id == 10000001)
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                            @else
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                            @endif
                                        @endif
                                    @endif
                                    @if ($user->isWriter())
                                    <td>
                                        <form action="{{route('users.make-admin', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{route('users.remove-writer', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Remove Writer</button>
                                        </form>
                                    </td>
                                    @endif
                                    @if ($user->isGuest())
                                    <td>
                                        <form action="{{route('users.make-writer', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Make Writer</button>
                                        </form>
                                    </td>
                                    <td>

                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h3 class="text-center">No Users Yet</h3>
                @endif
            @endif
        </div>
    </div>



@endsection

@section('third_party_scripts')
<script>
    $(function () {
        $('#userTable').DataTable({
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
@endsection
