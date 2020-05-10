@extends('layouts.dashboard')

@section('content')

<section class="section py-9" style="background-image: url({{asset('/img/preview/awc1.jpg')}})" data-overlay="5">

    <div class="container">
      <h2 class="text-white text-center">{{ __('Login') }}</h2>
      <p class="text-white text-center opacity-70 lead">Sign into your account.</p>
      <br>

      <div class="row">
        <form method="POST" action="{{ route('login') }}" class="col-11 col-md-6 col-xl-5 mx-auto section-dialog bg-gray p-5 p-md-7">
            @csrf
            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Email') }}</label>

            <div class="form-group input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope-o fa-fw"></i></span>
                    </div>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>

            <div class="form-group input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span>
                    </div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group flexbox py-3">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="custom-control-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>


                <a class="text-muted small-2" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
      </div>
    </div>
</section>
@endsection
