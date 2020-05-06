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
              <p class="lead-2 mt-5">Browse through our upcoming events and RSVP</p>

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
                        <div class="card border hover-shadow-6 mb-6 d-block">
                            <a href="{{route('dashboard.show',$post->id)}}"><img class="card-img-top" src="{{ asset($post->image) }}" alt="Card image cap"></a>
                            <div class="p-6 text-center">
                            <p><a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="{{route('categories.edit', $post->category->id)}}">{{$post->category->name}}</a></p>
                            <h5 class="mb-0"><a class="text-dark" href="{{route('dashboard.show',$post->id)}}">{{ $post->title }}</a></h5>
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

