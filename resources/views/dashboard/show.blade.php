@extends('layouts.dashboard')

@section('title')
   {{ $post->title }} || After Work Chills
@endsection

@section('header')

    <!-- Header -->
    <header class="header text-white h-fullscreen pb-80" style="background-image: url({{ $post->imageUrl }});" data-overlay="7">
        <div class="container text-center">

          <div class="row h-100">
            <div class="col-lg-8 mx-auto align-self-center">

            <p class="opacity-70 text-uppercase small ls-1">{{$post->category->name}}</p>
              <h1 class="display-4 mt-7 mb-8">{{$post->title}}</h1>
              <p><span class="opacity-70 mr-1">By</span> <a class="text-white" href="#">{{$post->user->name}}</a></p>
            <p><img class="avatar avatar-sm" src="{{ Gravatar::src($post->user->email)}}" alt="..."></p>

            </div>

            <div class="col-12 align-self-end text-center">
            <a class="scroll-down-1 scroll-down-white" href="#section-content"><span></span></a>
            </div>

          </div>

        </div>
      </header><!-- /.header -->
@endsection


@section('content')
<!-- Main Content -->
<main class="main-content">


    <!--
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    | Blog content
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    !-->
    <div class="section" id="section-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            {!!$post->content!!}
            <div class="addthis_inline_share_toolbox"></div>
            <div class="gap-xy-2 mt-6">
                @foreach ($post->tags as $tag)
            <a class="badge badge-pill badge-secondary" href="{{route('dashboard.tag',$tag->id)}}">{{$tag->name}}</a>
                @endforeach
            </div>
          </div>
        </div>


      </div>
    </div>



    <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Comments
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <div class="section bg-gray">
        <div class="container">

          <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="card my-4">
                    <div class="card-header">
                        Add a Comment
                    </div>
                    <div class="card-body">
                        @auth
                            <form action="{{ route('comments.store', $post->slug)}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                    <input class="form-control" type="text" value="{{auth()->user()->name}}" readonly>
                                    </div>

                                    <div class="form-group col-12 col-md-6">
                                    <input class="form-control" type="text" value="{{auth()->user()->email}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <textarea name="content" class="form-control" placeholder="Comment" rows="4"></textarea>
                                </div>

                                <button class="btn btn-primary btn-block" type="submit">Submit your comment</button>
                            </form>
                        @else
                            <a href="{{route('login')}}" class="btn btn-info text-white"> Sign in to Add a comment</a>
                        @endauth
                    </div>
                </div>

                <hr>

                @if ($post->comments->count() > 0)
                    @foreach ($post->comments as $comment)
                            <div class="media-list">
                                <div class="media">
                                <img class="avatar avatar-sm mr-4" src="{{ Gravatar::src($comment->owner->email)}}" alt="...">

                                    <div class="media-body">
                                        <div class="small-1">
                                        <strong>{{$comment->owner->name}}</strong>
                                        <time class="ml-4 opacity-70 small-3" datetime="2018-07-14 20:00">{{ $comment->created_at->diffforhumans()}}</time>
                                        </div>
                                        <p class="small-2 mb-0">{{ $comment->content}}</p>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                @else
                    <div class="d-flex justify-content-center text-center">
                         No Comments for this post
                    </div>
                @endif

            </div>
          </div>

        </div>
      </div>
  </main>
@endsection
