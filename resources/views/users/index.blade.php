@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Users
        </div>
        @if (auth()->user()->isSuperAdmin())
            <div class="card-body">
                @if ($users->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="row">#</th>
                                <th>Image</th>
                                <th>Name</th>
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
                                        @if ($user->role == 'superadmin')
                                            Super Admin
                                        @else
                                            @if ($user->role == 'admin')
                                                Admin
                                            @else
                                                @if ($user->role == 'writer')
                                                    Writer
                                                @else
                                                    User
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
                                            @if ($user->id == 1000)
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
                @else
                    <h3 class="text-center">No Users Yet</h3>
                @endif
            </div>

        @else
            <div class="card-body">
                @if ($users->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="row">#</th>
                                <th>Image</th>
                                <th>Name</th>
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
                                        @if ($user->role == 'superadmin')
                                            Super Admin
                                        @else
                                            @if ($user->role == 'admin')
                                                Admin
                                            @else
                                                @if ($user->role == 'writer')
                                                    Writer
                                                @else
                                                    User
                                                @endif
                                            @endif
                                        @endif
                                    </td>
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
                                    @if ($user->isAdmin())
                                        @if ($user->id == auth()->user()->id)
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        @else
                                        <td>

                                        </td>
                                        <td>
                                            <form action="{{route('users.remove-admin', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Remove Admin</button>
                                            </form>
                                        </td>
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">No Users Yet</h3>
                @endif
            </div>
        @endif
    </div>



@endsection
