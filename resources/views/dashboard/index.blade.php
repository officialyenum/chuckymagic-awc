@extends('layouts.dashboard')

@section('title')
   AWC
@endsection

@section('header')
    <!-- Header -->
    <header class="header text-white h-fullscreen" style="background-image: url({{asset('img/preview/awc1.jpg')}});" data-overlay="7">
        <canvas class="constellation" data-color="rgba(255,255,255,0.3)"></canvas>
        <div class="container text-center">

        <div class="row">
            <div class="col-lg-8 mt-10 mx-auto">

                <h1>We <span class="text-primary" data-typing="Party, Network, Support, are a Family"></span></h1>
                {{-- <p class="lead-2 mt-5">Browse through our upcoming events and RSVP</p> --}}
                <p class="lead-2 mt-5">Platform Still Under Construction</p>

                <hr class="w-60px my-7">

                <a class="btn btn-lg btn-round btn-white" href="#dashboard">Browse</a>

            </div>
        </div>

        </div>
    </header><!-- /.header -->
@endsection


@section('content')
    <!-- Main Content -->
    <main id="dashboard" class="main-content">
        <div class="section bg-gray">
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
                                        <div class="media-body">By <a href="{{route('dashboard.profile',$post->user->id)}}">{{ $post->user->username }}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                    </div>
                @empty
                    @if ($search)
                        <p class="text-center">
                            No results found for the search " <strong>{{ $search }}</strong> "
                        </p>
                    @else
                        <p class="text-center">
                            No results found"
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

