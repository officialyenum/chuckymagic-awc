@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Users
        </div>
        @if (auth()->user()->isSuperAdmin())
            <div class="card-body">
                @if ($users->count() > 0)
                    <table class="table">
                        <thead>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
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
                                    <td>
                                        @if ($user->isAdmin())
                                            <form action="{{route('users.make-super-admin', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Make Super Admin</button>
                                            </form>

                                            <form action="{{route('users.make-writer', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Make Writer</button>
                                            </form>
                                        @endif
                                        @if ($user->isSuperAdmin())
                                            @if ($user->name == auth()->user()->name)

                                            @else
                                                @if ($user->id == 1)

                                                @else
                                                    <form action="{{route('users.remove-super-admin', $user->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">Remove Super Admin</button>
                                                    </form>
                                                @endif
                                            @endif
                                        @endif
                                        @if ($user->isWriter())
                                            <form action="{{route('users.make-admin', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                                            </form>
                                            <form action="{{route('users.remove-writer', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Remove Writer</button>
                                            </form>
                                        @endif
                                        @if ($user->isGuest())
                                            <form action="{{route('users.make-writer', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Make Writer</button>
                                            </form>
                                        @endif
                                    </td>
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
                    <table class="table">
                        <thead>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
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
                                    <td>
                                        @if ($user->isGuest())
                                        <form action="{{route('users.make-writer', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Make Writer</button>
                                        </form>
                                        @endif
                                        @if ($user->isWriter())
                                        <form action="{{route('users.remove-writer', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Remove Writer</button>
                                        </form>
                                        <form action="{{route('users.make-admin', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                                        </form>
                                        @endif
                                        @if ($user->isAdmin())
                                            @if ($user->id == auth()->user()->id)

                                            @else
                                                <form action="{{route('users.remove-admin', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove Admin</button>
                                                </form>
                                            @endif
                                        @endif
                                    </td>
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
