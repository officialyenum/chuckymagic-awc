@extends('layouts.dashboard')

@section('content')


<section class="section py-9" style="background-image: url({{asset('/img/preview/awc1.jpg')}})" data-overlay="5">

    <div class="container">
        <h2 class="text-white text-center">{{ __('Verify Your Email Address') }}</h2>
        <p class="text-white text-center opacity-70">
            <div class="d-flex justify-content-center">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            </div>
            <div class="d-flex justify-content-center text-white">
                {{ __('Before proceeding, please check your email for a verification link.') }}
            </div>
            <div class="d-flex justify-content-center text-white mb-10">
                {{ __('If you did not receive the email') }},
            </div>
            <div class="d-flex justify-content-center">
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-lg text-white btn-success">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </p>
        <br>
    </div>
</section>
@endsection
