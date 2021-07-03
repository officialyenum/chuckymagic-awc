@extends('layouts.profile')

@section('title')
   AWC
@endsection

@section('third_party_stylesheets')
    <!-- include summernote css -->
    <style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
    </style>
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet"> --}}
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet"/> --}}

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css"> --}}
@endsection

@section('header')
    <!-- Header -->
    @if (isset($user->header_image))
        <header class="header bg-dark bg-img h-300 mb-5" style="background-image: url({{ $user->header_image }});" data-overlay="6">
    @else
        <header class="header bg-dark">
    @endif
        <div class="container text-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
            @if (Auth::user()->id == $user->id)
                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#editUser">
                    Edit Profile
                </button>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#headerImageId">
                    Edit Header Image
                </button>

                <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#createPost">
                    Create Post
                </button>
            @endif
        </div>
    </header><!-- /.header -->
@endsection


@section('content')
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                {{-- <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
                </div> --}}
            </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="avatar" src="{{  $user->avatar ?? Gravatar::src($user->email)}}" alt="...">
                        </div>
                        @if (Auth::user()->id == $user->id)
                            <div class="text-center">
                                <!-- Button trigger modal -->
                                <i type="button" class="btn btn-primary fas fa-pencil-alt mb-4 ml-8" data-toggle="modal" data-target="#avatarImageId" aria-hidden="true"></i>


                                {{-- <a name="" id="editHeader" class="btn btn-primary" href="#" role="button"></a> --}}
                                {{-- <h1 class="display-4 text-white mb-6"><strong>{{$user->name}}</strong></h1> --}}
                            </div>
                        @endif

                        <h3 class="profile-username text-center">{{$user->username}}</h3>

                        <p class="text-muted text-center">{{$user->job->name ?? ''}}</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Education</strong>

                    <p class="text-muted">
                        {{$user->education ?? "B.S. in Computer Science from the University of Tennessee at Knoxville"}}
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                    <p class="text-muted">{{$user->location ?? "Malibu, California"}}</p>

                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                    <p class="text-muted">
                        @foreach ($user->skills as $skill)
                            <span class="tag tag-danger">{{$skill->name}}</span>
                        @endforeach
                    </p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#post" data-toggle="tab">My Posts</a></li>
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                        @if (Auth::user()->id == $user->id)
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                        @endif
                    </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="post">
                            @foreach ($posts as $post)

                            <!-- Post -->
                            <div class="post my-5">
                                <h3>
                                    {{ $post->title}} - <time class="ml-4 opacity-70 small-3" datetime="2018-07-14 20:00">{{ $post->created_at->diffforhumans()}}</time>
                                </h3>
                                <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="{{$post->imageUrl}}" width="100" height="100" alt="post image">
                                <span class="username">
                                    <a href="{{route('dashboard.category', $post->category->id )}}">{{$post->category->name}}</a>
                                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                </span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                {{ $post->description}}
                                </p>

                                <p>
                                    <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                    <a href="#" class="link-black text-sm"><i class="far fa-like mr-1"></i> Like</a>
                                    <a href="{{route('dashboard.show',$post->slug)}}" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Read more...</a>
                                    <span class="float-right">
                                        <a href="#" class="link-black text-sm">
                                            <i class="far fa-comments mr-1"></i> Comments ({{$post->comments->count()}})
                                        </a>
                                    </span>
                                </p>
                            </div>
                            <!-- /.post -->
                            @endforeach
                        </div>

                        <div class="tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                <span class="username">
                                    <a href="#">Jonathan Burke Jr.</a>
                                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                </span>
                                <span class="description">Shared publicly - 7:30 PM today</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore the hate as they create awesome
                                tools to help create filler text for everyone from bacon lovers
                                to Charlie Sheen fans.
                                </p>

                                <p>
                                <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                <span class="float-right">
                                    <a href="#" class="link-black text-sm">
                                    <i class="far fa-comments mr-1"></i> Comments (5)
                                    </a>
                                </span>
                                </p>

                                <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post clearfix">
                                <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                                <span class="username">
                                    <a href="#">Sarah Ross</a>
                                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                </span>
                                <span class="description">Sent you a message - 3 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore the hate as they create awesome
                                tools to help create filler text for everyone from bacon lovers
                                to Charlie Sheen fans.
                                </p>

                                <form class="form-horizontal">
                                <div class="input-group input-group-sm mb-0">
                                    <input class="form-control form-control-sm" placeholder="Response">
                                    <div class="input-group-append">
                                    <button type="submit" class="btn btn-danger">Send</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                                <span class="username">
                                    <a href="#">Adam Jones</a>
                                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                </span>
                                <span class="description">Posted 5 photos - 5 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <div class="row mb-3">
                                <div class="col-sm-6">
                                    <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="row">
                                    <div class="col-sm-6">
                                        <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                                        <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                        <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                                        <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                    </div>
                                    <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <p>
                                <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                <span class="float-right">
                                    <a href="#" class="link-black text-sm">
                                    <i class="far fa-comments mr-1"></i> Comments (5)
                                    </a>
                                </span>
                                </p>

                                <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                            </div>
                            <!-- /.post -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="timeline-alt pb-0">
                                        <div class="timeline-item">
                                            <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <a href="#" class="text-info font-weight-bold mb-1 d-block">You sold an item</a>
                                                <small>Paul Burgess just purchased “Hyper - Admin Dashboard”!</small>
                                                <p>
                                                    <small class="text-muted">5 minutes ago</small>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="timeline-item">
                                            <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <a href="#" class="text-primary font-weight-bold mb-1 d-block">Product on the Bootstrap Market</a>
                                                <small>Dave Gamache added
                                                    <span class="font-weight-bold">Admin Dashboard</span>
                                                </small>
                                                <p>
                                                    <small class="text-muted">30 minutes ago</small>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="timeline-item">
                                            <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <a href="#" class="text-info font-weight-bold mb-1 d-block">Robert Delaney</a>
                                                <small>Send you message
                                                    <span class="font-weight-bold">"Are you there?"</span>
                                                </small>
                                                <p>
                                                    <small class="text-muted">2 hours ago</small>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="timeline-item">
                                            <i class="mdi mdi-upload bg-primary-lighten text-primary timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <a href="#" class="text-primary font-weight-bold mb-1 d-block">Audrey Tobey</a>
                                                <small>Uploaded a photo
                                                    <span class="font-weight-bold">"Error.jpg"</span>
                                                </small>
                                                <p>
                                                    <small class="text-muted">14 hours ago</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <form action="{{ route('users.update-profile')}}" method="POST" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name" value="{{ $user->username }}">
                                </div>
                                </div>
                                <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ $user->email }}">
                                </div>
                                </div>
                                <div class="form-group row">
                                <label for="inputEducation" class="col-sm-2 col-form-label">Education</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEducation" placeholder="Education" value="{{ $user->education ?? " " }}">
                                </div>
                                </div>
                                <div class="form-group row">
                                <label for="inputLocation" class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputLocation" placeholder="Location"></textarea>
                                </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                    {{-- <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                    </div> --}}
                                    @if ($user->skills->count() > 0)
                                        <div class="form-group">
                                            <label for="tags">Skills</label>
                                            <select name="skills[]" id="skills" class="form-control tags-selector" multiple="multiple" data-placeholder="Select Features" style="width: 100%;">
                                                @foreach ($user->skills as $skill)
                                                    <option value="{{ $tag->id }}"
                                                        @if (isset($user))
                                                            @if ($user->hasTag($skill->id))
                                                                selected
                                                            @endif
                                                        @endif
                                                        >
                                                        {{ $skill->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                    </label>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- Avatar Modal -->
    <div class="modal fade" id="avatarImageId" tabindex="-1" role="dialog" aria-labelledby="avatarImageId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Update Avatar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    @if (isset($user->avatar))
                        <div class="form-group">
                            <img src="{{ $user->avatar }}" alt="image" width="100%">
                        </div>
                    @endif
                    <div class="container-fluid">
                        <form action="{{ route('users.update-avatar', $user->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="form-control" name="avatar" id="avatar">
                        </div>

                        <div class="form-group">
                            {{-- <input type="button" value="Update Avatar" onclick="uploadAvatar()"> --}}
                            <button type="submit" class="btn btn-success">
                                Update Avatar
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Image Modal -->
    <div class="modal fade" id="headerImageId" tabindex="-1" role="dialog" aria-labelledby="headerImageId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Update Image Header</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    @if (isset($user->header_image))
                        <div class="form-group">
                            <img src="{{ $user->header_image }}" alt="image" width="100%">
                        </div>
                    @endif
                    <div class="container-fluid">
                        <form action="{{ route('users.update-header', $user->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="header_image">Header Image</label>
                                <input type="file" class="form-control" name="header_image" id="header_image">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    Update Header Image
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('modal.user')
    <!--Create Post Modal -->
    <div class="modal fade" id="createPost" data-toggle="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="createPostLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Create Post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>

                <div id='PleaseWaitCreate' class="text-center" style="display: none"><img class="m-auto" src='https://media.giphy.com/media/feN0YJbVs0fwA/giphy.gif'/></div>
                {{-- @include('partials.errors') --}}
                <form id="createPostForm" action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="">
                            </div>
                            <label for="image">Header Image</label>
                            {{-- <div class="form-group">
                                <label for="image">Header Image</label>
                                <input type="file" class="custom-file-input form-control" name="image" id="image">

                            </div> --}}
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="image" value="">
                                <label class="custom-file-label" for="image"></label>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" class="summernote"></textarea>
                                {{-- @trix(\App\Post::class, 'content') --}}
                                {{-- <label for="content">Content</label> --}}
                                {{-- <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : ''}}"> --}}
                                {{-- <trix-editor input="content"></trix-editor> --}}
                            </div>
                            {{-- <div class="form-group">
                                <label for="published_at">Published At</label>
                                <input type="text" class="form-control datetimepicker-input" name="published_at" id="published_at" value="">
                            </div> --}}
                            <div class="form-group">
                                <label for="published_at">Published At</label>
                                <div class="input-group date" id="published_at" data-target-input="nearest">
                                    <input type="datetime" class="form-control datepicker datetimepicker-input" data-target="#published_at"  name="published_at" value=""/>
                                    <div class="input-group-append" data-target="#published_at" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label for="event_day">Event Day</label>
                                <input type="text" class="form-control" name="event_day" id="event_day" value="{{ isset($post) ? $post->event_day : ''}}">
                            </div> --}}
                            <div class="form-group">
                                <label for="event_day">Event Day</label>
                                <div class="input-group date" id="event_day" data-target-input="nearest">
                                    <input type="datetime" class="form-control datepicker datetimepicker-input" data-target="#event_day" name="event_day" value=""/>
                                    <div class="input-group-append" data-target="#event_day" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" selected>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($tags->count() > 0)
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <select name="tags[]" id="tags" class="form-control tags-selector" multiple="multiple" data-placeholder="Select Tags" style="width: 100%;">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                @if (isset($post))
                                                    @if ($post->hasTag($tag->id))
                                                        selected
                                                    @endif
                                                @endif
                                                >
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button id="postButton" type="submit" class="btn btn-success">Add Post</button>
                    </div>
                    <div class="lock-modal"></div>
                    <div class="loading-circle"></div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('third_party_scripts')
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
    </script>
    <script>
        $(function () {
            $('#postTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            bsCustomFileInput.init();
            $('.summernote').summernote({
                tabsize: 2,
                height: 300
            });
            //Date range picker
            $('.datepicker').datetimepicker({
                format: "yyyy-MM-dd HH:mm:ss"
            });
            $('.tags-selector').select2();
            $('.skills-selector').select2();
            $('.custom-file-input').change(function() {
                var filename = $(this).val();
                var lastIndex = filename.lastIndexOf("\\");
                if (lastIndex >= 0) {
                    filename = filename.substring(lastIndex + 1);
                }
                $('.custom-file-label').val(filename);
            });
            //Initialize Select2 Elements
            // $('.tags-selector').select2({
            //     theme: 'bootstrap4'
            // })
        });
    </script>
    <script>
        var btn = document.getElementById('postButton');
        btn.onclick = function process() {
            var form = document.getElementById('createPostForm');
            form.style.display = 'none';
            var processing = document.createElement('span');
            // processing.appendChild(image);
            processing.appendChild(document.createTextNode('processing ...'));
            form.parentNode.insertBefore(processing, form);
            $("#overlay, #PleaseWaitCreate").show();
        }
        // function createPost(formId) {
        //     var form = document.getElementById(formId)
        //     console.log(form);
        //     form.style.display = 'none';
        //     var processing = document.createElement('span');
        //     processing.appendChild(image);
        //     processing.appendChild(document.createTextNode('processing ...'));
        //     form.parentNode.insertBefore(processing, form);
        //     form.submit();
        //     $("#overlay, #PleaseWaitCreate").show();
        // }

        function updatePost(formId, pleaseWaitEdit) {
            console.log(formId);
            var form = document.getElementById(formId)
            console.log(form);
            form.style.display = 'none';
            var processing = document.createElement('span');
            processing.appendChild(image);
            processing.appendChild(document.createTextNode('processing ...'));
            form.parentNode.insertBefore(processing, form);
            form.submit();
            $(`#overlay, #${pleaseWaitEdit}`).show();
        }
        function enableButton(btnId) {
            console.log(btnId);
            document.getElementById(btnId).disabled = false;
        }
        function handleDelete(slug) {
            var form = document.getElementById('deletePostForm')
            form.action = 'posts/' + slug
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

