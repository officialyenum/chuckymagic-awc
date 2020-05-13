<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>After Work Chills</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->

        <link href="{{asset('css/page.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="smart">
            <div class="container">

            <div class="navbar-left mr-4">
                <button class="navbar-toggler" type="button">&#9776;</button>
                <a class="navbar-brand" href="#">
                <img class="logo-dark" src="{{asset('img/awc-web-logo.png')}}" alt="logo">
                <img class="logo-light" src="{{asset('img/awc-web-logo.png')}}" alt="logo">
                </a>
            </div>

            <section class="navbar-mobile">
                <nav class="nav nav-navbar mr-auto">
                <a class="nav-link active" href="{{ route('dashboard')}} ">Home</a>
                <a class="nav-link" href="{{route('dashboard')}}">Events</a>
                <a class="nav-link" href="#">Activities</a>
                <a class="nav-link" href="#">Hangouts</a>
                <a class="nav-link" href="#">NewsLetter</a>
                <a class="nav-link" href="#">Contact</a>
                </nav>

                @auth
                    <a class="btn btn-sm btn-light ml-lg-5 mr-2" href="{{ route('dashboard')}}">Dashboard</a>
                @else
                    <a class="btn btn-sm btn-light ml-lg-5 mr-2" href="{{ route('login') }}">Login</a>

                    <a class="btn btn-sm btn-success" href="{{ route('register') }}">Register</a>
                @endauth
            </section>

            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Header -->
        <header id="home" class="header text-white h-fullscreen text-center text-lg-left" style="background-image: url({{asset('img/preview/awc1.jpg')}});" data-overlay="7">
            <canvas class="constellation" data-color="rgba(255,255,255,0.3)"></canvas>
            <div class="container">
            <div class="row align-items-center h-100">
                <div class="col-lg-6">
                <h1>Welcome to AWC</h1>
                <p class="lead mt-5 mb-8">Connect and chill after work.</p>
                <p class="gap-xy">
                    <a class="btn btn-round btn-outline-light mw-150" href="#section-welcome">Learn more</a>
                    <a class="btn btn-round btn-light mw-150" href="{{ route('register') }}">Sign up</a>
                </p>
                </div>

                <div class="col-lg-5 ml-auto">
                </div>

            </div>
            </div>
        </header>
        <!-- /.header -->

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
                <p class="lead">Holisticly implement fully tested process improvements rather than dynamic internal.</p>
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
            <section class="section bg-gray text-center">
            <div class="container">

                <header class="section-header">
                <small>Try It Now</small>
                <h2 class="lead-8"><strong>Get Started Free</strong></h2>
                <hr>
                <p class="lead">Sign up for free and become one of the millions of people around the world who have fallen in love with AWC.</p>
                </header>


                <div class="row">
                <form class="col-md-4 col-xl-4 mx-auto input-border">
                    <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Name">
                    </div>

                    <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Email">
                    </div>

                    <div class="form-group">
                    <input type="password" class="form-control form-control-lg" placeholder="Password">
                    </div>

                    <button class="btn btn-block btn-xl btn-success">Sign up</button>
                    <p class="small mt-3 opacity-70">or use your <a href="#">Facebook account</a></p>
                </form>
                </div>

            </div>
            </section>

        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
            <div class="row gap-y align-items-center">

                <div class="col-md-3 text-center text-md-left">
                <a href="#"><img src="{{asset('img/awc-web-logo.png')}}" alt="logo"></a>
                </div>

                <div class="col-md-6">
                <div class="nav nav-center">
                    <a class="nav-link" href="#">About</a>
                    <a class="nav-link" href="#">Events</a>
                    <a class="nav-link" href="#">Policy</a>
                    <a class="nav-link" href="#">Contact</a>
                </div>
                </div>

                <div class="col-md-3 text-center text-md-right">
                <small>Built by Chuckymagic for AWC© 2020. All rights reserved.</small>
                </div>

            </div>
            </div>
        </footer>
        <!-- /.footer -->

        <!-- Scripts -->
        <script src="{{asset('js/page.min.js')}}"></script>
        <script src="{{asset('js/script.js')}}"></script>
    </body>
</html>
