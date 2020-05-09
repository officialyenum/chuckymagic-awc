@extends('layouts.dashboard')

@section('title')
   {{$category->name}}
@endsection

@section('header')

    <!-- Header -->
    <header class="header text-white h-fullscreen pb-80" style="background-image: url({{asset('img/preview/awc-logo.jpg')}});" data-overlay="7">
        <div class="container text-center">

          <div class="row h-100">
            <div class="col-lg-8 mx-auto align-self-center">
                <p class="opacity-70 text-uppercase small ls-1">Post Count : {{$category->posts->count()}}</p>
                <h1 class="display-4 mt-7 mb-8">{{$category->name}}</h1>
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
                    <div class="card border hover-shadow-6 mb-6 d-block">
                        <a href="#"><img class="card-img-top" src="{{ asset($post->image) }}" alt="Card image cap"></a>
                        <div class="p-6 text-center">
                        <p><a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="{{route('categories.edit', $post->category->id)}}">{{$post->category->name}}</a></p>
                        <h5 class="mb-0"><a class="text-dark" href="{{route('dashboard.show',$post->id)}}">{{ $post->title }}</a></h5>
                        </div>
                    </div>
                    </div>
                @empty
                    @if ($search)
                        <p class="text-center">
                            No results found for "<strong> {{request()->query('search')}} </strong>" in "<strong> {{ $category->name }}</strong>"
                        </p>
                    @else
                        <p class="text-center">
                            No results found in "<strong> {{ $category->name }}</strong>"
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

