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
                <p class="lead-2 mt-5">Site Still Under Construction</p>

                <hr class="w-60px my-7">

                <a class="btn btn-lg btn-round btn-white" href="#section-welcome">Browse</a>

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
        | Welcome
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <section id="section-welcome"class="section">
        <div class="container">
            <header class="section-header">
            <small>Welcome</small>
            <h2>Get a Better Understanding</h2>
            <hr>
            <p class="lead">Connect and chill after work with work buddies.</p>
            </header>



            <div class="row gap-y">

                <div class="col-md-8 mx-auto">
                    <img src="{{asset('img/preview/awc-logo.jpg')}}" alt="..." data-aos="fade-up" data-aos-duration="2000">
                </div>


                <div class="w-100"></div>

            </div>

        </div>
        </section>


        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Features
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <section id="section-features" class="section bg-gray">
            <div class="container">
                <header class="section-header">
                <h2>The AfterWorkChills Playbook</h2>
                <hr>
                </header>


                <div class="row gap-y align-items-center">
                <div class="col-md-6 ml-auto">
                    <h4>AWC Manifesto</h4>
                    <p>To Create an atmosphere where people of different Personalities, Nationalities yet similar mindset can interact in harmony, network and support one another’s growth through recreation.</p>
                </div>

                <div class="col-md-5 order-md-first">
                    <img class="rounded shadow-2" src="{{asset('img/preview/awc1.jpg')}}" alt="...">
                </div>
                </div>


                <hr class="my-8">


                <div class="row gap-y align-items-center">
                <div class="col-md-6 mr-auto">
                    <h4>AWC Mission</h4>
                    <p>To create a safe space to develop lasting relationships that allow every member grow both personally and professionally; in addition to unparalleled business growth.
                    </p>
                </div>

                <div class="col-md-5">
                    <img class="rounded shadow-2" src="{{asset('img/preview/awc2.jpg')}}" alt="...">
                </div>
                </div>


                <hr class="my-8">


                <div class="row gap-y align-items-center">
                <div class="col-md-6 ml-auto">
                    <h4>AWC Vision</h4>
                    <p>Lasting connections that transcends borders, race, colour and language.
                    </p>
                </div>

                <div class="col-md-5 order-md-first">
                    <img class="rounded shadow-2" src="{{asset('img/preview/awc3.jpg')}}" alt="...">
                </div>
                </div>

                <hr class="my-8">

                <header class="section-header">
                    <h2>The AWC Dream</h2>
                    <hr>
                    <p class="lead">That one day we will transcend to a point where we will have factions of this community across the globe.
                    </p>
                    </header>


            </div>
        </section>


        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Pricing
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        {{-- <section id="section-pricing" class="section">
            <div class="container">
                <header class="section-header">
                <small>Plans</small>
                <h2>Pricing</h2>
                <hr>
                <p class="lead">Choose any of the following plans to get start with. You can start with the FREE plan to see our web application at first. You can always change your plan from your account.</p>
                </header>


                <div class="text-center my-7">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-round btn-outline-secondary w-150 active">
                    <input type="radio" name="pricing" value="monthly" autocomplete="off" checked> Monthly
                    </label>
                    <label class="btn btn-round btn-outline-secondary w-150">
                    <input type="radio" name="pricing" value="yearly" autocomplete="off"> Yearly
                    </label>
                </div>
                </div>


                <div class="row gap-y text-center">

                <div class="col-md-4">
                    <div class="pricing-1">
                    <p class="plan-name">Free</p>
                    <br>
                    <h2 class="price">0</h2>
                    <p class="small">&nbsp;</p>

                    <div class="text-muted">
                        <small>1 Repository</small><br>
                        <small>1 Private Project</small><br>
                        <small>100 MB Attachment</small><br>
                    </div>

                    <br>
                    <p class="text-center py-3">
                        <a class="btn btn-primary" href="#">Get started</a>
                    </p>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="pricing-1 popular">
                    <p class="plan-name">Personal</p>
                    <br>
                    <h2 class="price text-success">
                        <span class="price-unit">$</span>
                        <span data-bind-radio="pricing" data-monthly="9" data-yearly="99">9</span>
                        <span class="plan-period" data-bind-radio="pricing" data-monthly="/mo" data-yearly="/yr">/mo</span>
                    </h2>
                    <p class="small">&nbsp;</p>

                    <div class="text-muted">
                        <small>1 Repository</small><br>
                        <small>10 Private Project</small><br>
                        <small>10 GB attachment</small><br>
                    </div>

                    <br>
                    <p class="text-center py-3">
                        <a class="btn btn-success" href="#" data-bind-href="pricing" data-monthly="#monthly" data-yearly="#yearly">Get started</a>
                    </p>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="pricing-1">
                    <p class="plan-name">Team</p>
                    <br>
                    <h2 class="price">
                        <span class="price-unit">$</span>
                        <span data-bind-radio="pricing" data-monthly="39" data-yearly="399">39</span>
                        <span class="plan-period" data-bind-radio="pricing" data-monthly="/mo" data-yearly="/yr">/mo</span>
                    </h2>
                    <p class="small">&nbsp;</p>

                    <div class="text-muted">
                        <small>5 Repository</small><br>
                        <small>25 Private Project</small><br>
                        <small>100 GB attachments</small><br>
                    </div>

                    <br>
                    <p class="text-center py-3">
                        <a class="btn btn-primary" href="#" data-bind-href="pricing" data-monthly="#monthly" data-yearly="#yearly">Get started</a>
                    </p>
                    </div>
                </div>

                </div>


            </div>
        </section> --}}


        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Signup
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <section id="signupsection" class="section bg-gray text-center">
            <div class="container">

                <header class="section-header">
                <small>Try It Now</small>
                <h2 class="lead-8"><strong>Get Started Free</strong></h2>
                <hr>
                <p class="lead">Sign up for free and become one of the millions of people around the world who have fallen in love with AWC.</p>
                </header>


                <div class="row">
                    {{-- <form method="POST" action="{{ route('register') }}" class="col-11 col-md-6 col-xl-5 mx-auto section-dialog bg-gray p-5 p-md-7">
                        @csrf
                        <label for="username" class="col-md-4 col-form-label text-md-left">{{ __('Username') }}</label>
                        <div class="form-group input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
                            </div>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
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
                    </form> --}}
                    <form method="POST" action="{{ route('register') }}" class="col-md-4 col-xl-4 mx-auto input-border">
                        @csrf
                        <div class="form-group">
                            <input id="username" type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username" autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>

                        <div class="form-group">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">Terms</a>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-lg btn-success">{{ __('Register') }}</button>
                        </div>

                        {{-- <button class="btn btn-block btn-xl btn-success">Sign up</button>
                        <p class="small mt-3 opacity-70">or use your <a href="#">Facebook account</a></p> --}}
                    </form>
                </div>

            </div>
        </section>

    </main>
@endsection

