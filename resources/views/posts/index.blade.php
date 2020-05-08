@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create')}}" class="btn btn-success float-right my-2">Add Post </a>
    </div>


    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>
        @if (auth()->user()->isSuperAdmin())
            <div class="card-body">
                @if ($posts->count() > 0 )
                    @if (!auth()->user()->isAdmin())
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="row">#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Edit/Restore</th>
                            <th>Trash/Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>
                                        {{ $post->id }}
                                    </td>
                                    <td>
                                        <img src="{{ asset($post->image) }}" alt="post image" width="40px"  height="40px">
                                    </td>
                                    <td>
                                        {{ $post->title }}
                                    </td>
                                    <td>
                                        <a href="{{route('categories.edit', $post->category->id)}}">{{ $post->category->name}}</a>
                                    </td>

                                    <td>
                                        @if ($post->trashed())
                                                <form action="{{route('restore-posts', $post->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"  class="btn btn-primary float-right ml-1">Restore</button>
                                                </form>
                                        @else
                                                <a href="{{ route('posts.edit', $post->id)}}"  class="btn btn-primary float-right ml-1">Edit</a>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($post->trashed())
                                            <button class="btn btn-danger float-right ml-1" onclick="handleDelete({{ $post->id }})">Delete</button>
                                        @else
                                            <form action="{{ route('posts.destroy', $post->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger float-right ml-1">
                                                    Trash
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="row">#</th>
                                    <th></th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($post->image) }}" alt="post image" width="40px"  height="40px">
                                        </td>
                                        <td>
                                            {{ $post->title }}
                                        </td>
                                        <td>
                                            <a href="{{route('categories.edit', $post->category->id)}}">{{ $post->category->name}}</a>
                                        </td>
                                        <td>
                                            @if ($post->trashed())
                                                    <form action="{{route('restore-posts', $post->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"  class="btn btn-primary float-right ml-1">Restore</button>
                                                    </form>
                                            @else
                                                    <a href="{{ route('posts.edit', $post->id)}}"  class="btn btn-primary float-right ml-1">Edit</a>
                                            @endif

                                        </td>
                                        <td>
                                            @if ($post->trashed())
                                                <button class="btn btn-danger float-right ml-1" onclick="handleDelete({{ $post->id }})">Delete</button>
                                            @else
                                                <form action="{{ route('posts.destroy', $post->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger float-right ml-1">
                                                        Trash
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @else
                    <h3 class="text-center">No Posts Yet</h3>
                @endif
            </div>
        @else
            @if (auth()->user()->isAdmin())
                <div class="card-body">
                    @if ($posts->count() > 0 )
                        @if (!auth()->user()->isAdmin())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="row">#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>
                                                {{ $post->id }}
                                            </td>
                                            <td>
                                                <img src="{{ asset($post->image) }}" alt="post image" width="40px"  height="40px">
                                            </td>
                                            <td>
                                                {{ $post->title }}
                                            </td>
                                            <td>
                                                <a href="{{route('categories.edit', $post->category->id)}}">{{ $post->category->name}}</a>
                                            </td>
                                            <td>
                                                @if ($post->trashed())
                                                        <form action="{{route('restore-posts', $post->id)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"  class="btn btn-primary float-right ml-1">Restore</button>
                                                        </form>
                                                @else
                                                        <a href="{{ route('posts.edit', $post->id)}}"  class="btn btn-primary float-right ml-1">Edit</a>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($post->trashed())
                                                    <button class="btn btn-danger float-right ml-1" onclick="handleDelete({{ $post->id }})">Delete</button>
                                                @else
                                                    <form action="{{ route('posts.destroy', $post->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger float-right ml-1">
                                                            Trash
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="row">#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>
                                                {{ $post->id }}
                                            </td>
                                            <td>
                                                <img src="{{ asset($post->image) }}" alt="post image" width="40px"  height="40px">
                                            </td>
                                            <td>
                                                {{ $post->title }}
                                            </td>
                                            <td>
                                                <a href="{{route('categories.edit', $post->category->id)}}">{{ $post->category->name}}</a>
                                            </td>
                                            @if ($post->trashed())
                                                <td>
                                                    <form action="{{route('restore-posts', $post->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"  class="btn btn-primary float-right ml-1">Restore</button>
                                                    </form>
                                                </td>
                                            @else
                                                <td>
                                                    <a href="{{ route('posts.edit', $post->id)}}"  class="btn btn-primary float-right ml-1">Edit</a>
                                                </td>
                                            @endif
                                            <td>
                                            <form action="{{ route('posts.destroy', $post->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger float-right ml-1">
                                                    {{ $post->trashed() ? 'Delete' : 'Trash '}}
                                                </button>
                                            </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                    @else
                        <h3 class="text-center">No Posts Yet</h3>
                    @endif
                </div>
            @else
                <div class="card-body">
                    @if ($posts->count() > 0 )
                        @if (!auth()->user()->isAdmin())
                            <table class="table">
                                <thead>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($user->posts as $post)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($post->image) }}" alt="post image" width="40px"  height="40px">
                                            </td>
                                            <td>
                                                {{ $post->title }}
                                            </td>
                                            <td>
                                                <a href="{{route('categories.edit', $post->category->id)}}">{{ $post->category->name}}</a>
                                            </td>
                                            <td>
                                                @if ($post->trashed())
                                                        <form action="{{route('restore-posts', $post->id)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"  class="btn btn-primary float-right ml-1">Restore</button>
                                                        </form>
                                                @else
                                                        <a href="{{ route('posts.edit', $post->id)}}"  class="btn btn-primary float-right ml-1">Edit</a>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($post->trashed())
                                                    <button class="btn btn-danger float-right ml-1" onclick="handleDelete({{ $post->id }})">Delete</button>
                                                @else
                                                    <form action="{{ route('posts.destroy', $post->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger float-right ml-1">
                                                            Trash
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <table class="table">
                                <thead>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($post->image) }}" alt="post image" width="40px"  height="40px">
                                            </td>
                                            <td>
                                                {{ $post->title }}
                                            </td>
                                            <td>
                                                <a href="{{route('categories.edit', $post->category->id)}}">{{ $post->category->name}}</a>
                                            </td>
                                            <td>
                                                @if ($post->trashed())
                                                        <form action="{{route('restore-posts', $post->id)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"  class="btn btn-primary float-right ml-1">Restore</button>
                                                        </form>
                                                @else
                                                        <a href="{{ route('posts.edit', $post->id)}}"  class="btn btn-primary float-right ml-1">Edit</a>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($post->trashed())
                                                    <button class="btn btn-danger float-right ml-1" onclick="handleDelete({{ $post->id }})">Delete</button>
                                                @else
                                                    <form action="{{ route('posts.destroy', $post->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger float-right ml-1">
                                                            Trash
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    @else
                        <h3 class="text-center">No Posts Yet</h3>
                    @endif
                </div>
            @endif
        @endif
    </div>



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

@section('css')
    @trixassets
@endsection

@section('scripts')

    <script>
        function handleDelete(id) {
            var form = document.getElementById('deletePostForm')
            form.action = 'posts/' + id
            console.log('deleting', form);

            $('#deleteModal').modal('show')
        }
    </script>

@endsection
