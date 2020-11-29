@extends('layouts.dashboard')

@section('content')

<section class="section py-9" style="background-image: url({{asset('/img/preview/awc1.jpg')}})" data-overlay="5">

    <div class="container">
        <h2 class="text-white text-center">{{ __('Register') }}</h2>
        <p class="text-white text-center opacity-70 lead">Start to explore.</p>
        <br>

        <div class="row">
            <form method="POST" action="{{ route('register') }}" class="col-11 col-md-6 col-xl-5 mx-auto section-dialog bg-gray p-5 p-md-7">
                @csrf
                <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Name') }}</label>
                <div class="form-group input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
                    </div>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Email') }}</label>

                <div class="form-group input-group input-group-lg">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope-o fa-fw"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                <div class="form-group input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span>
                    </div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-block btn-lg btn-success">{{ __('Register') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>

    </div>
</section>

@endsection

