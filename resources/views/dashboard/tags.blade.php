@extends('layouts.dashboard')

@section('title')
   {{$tag->name}} || After Work Chills
@endsection

@section('header')

    <!-- Header -->
    <header class="header text-white h-fullscreen pb-80" style="background-image: url({{asset('img/preview/awc-logo.jpg')}});" data-overlay="7">
        <div class="container text-center">

          <div class="row h-100">
            <div class="col-lg-8 mx-auto align-self-center">
                <p class="opacity-70 text-uppercase small ls-1">Post Count : {{$tag->posts->count()}}</p>
                <h1 class="display-4 mt-7 mb-8">{{$tag->name}}</h1>
                <p><span class="opacity-70 mr-1">Logged User : </span> <a class="text-white" href="#">
                    @auth
                        {{ Auth::user()->name }}
                    @else
                        Guest
                    @endauth
                </p>
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
        <div class="section bg-gray" id="section-content">
        <div class="container">
            <div class="row">
            <div class="col-md-8 col-xl-9">
                <div class="row gap-y">
                @forelse ($posts as $post)
                    <div class="col-md-6">
                        <div class="col-12 col-lg-12">
                            <div class="card text-white bg-img h-300 mb-5" style="background-image: url({{ $post->imageUrl }});" data-overlay="6">
                                <div class="row h-100 p-5">
                                    <div class="col-12">
                                        <a class="text-white" href="{{route('dashboard.show',$post->slug)}}">{{$post->category->name}}</a>
                                    </div>

                                    <div class="col-12 align-self-end">
                                        <h3 class="card-title fw-200"><a href="{{route('dashboard.show',$post->slug)}}">{{$post->title }}</a></h3>
                                        <div class="media align-items-center">
                                        <img class="avatar avatar-xs mr-3" src="{{ Gravatar::src($post->user->email)}}" alt="...">
                                        <div class="media-body">By {{ $post->user->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    @if ($search)
                        <p class="text-center">
                            No results found for "<strong> {{request()->query('search')}} </strong>" in "<strong> {{ $tag->name }}</strong>"
                        </p>
                    @else
                        <p class="text-center">
                            No results found in "<strong> {{ $tag->name }}</strong>"
                        </p>
                    @endif
                @endforelse

                </div>
                {{-- <nav class="flexbox mt-30">
                <a class="btn btn-white disabled"><i class="ti-arrow-left fs-9 mr-4"></i> Newer</a>
                <a class="btn btn-white" href="#">Older <i class="ti-arrow-right fs-9 ml-4"></i></a>
                </nav> --}}
                {{ $posts->appends(['search' => request()->query('search')])->links()}}
            </div>

            @include('partials.sidebar')

            </div>
        </div>
        </div>
    </main>
@endsection

