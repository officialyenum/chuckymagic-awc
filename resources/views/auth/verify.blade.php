@extends('layouts.app')

@section('content')


<section class="section py-9" style="background-image: url({{asset('/img/preview/awc1.jpg')}})" data-overlay="5">

    <div class="container">
      <h2 class="text-white text-center">{{ __('Register') }}</h2>
      <p class="text-white text-center opacity-70 lead">Start to explore.</p>
      <br>

      <div class="row">

        <div class="card">
            <div class="card-header">{{ __('Verify Your Email Address') }}</div>

            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </div>
      </div>

    </div>
</section>
@endsection
