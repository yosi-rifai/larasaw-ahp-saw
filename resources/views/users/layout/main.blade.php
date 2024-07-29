<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @php
        $currentSegment = request()->segment(count(request()->segments()));
        $pageTitle = ucfirst(str_replace('-', ' ', $currentSegment));
    @endphp
    <title>{{ $pageTitle }}</title>
    <link rel="icon" href="{{ asset('user/img/core-img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('user/style.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @yield('style')
</head>

<body>
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="cssload-container">
            <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
        </div>
    </div>

    <header class="header-area">
        @include('users.partials.navbar')
    </header>

    <section class="hero-area">
        @include('users.partials.hero')
    </section>

    <div class="book-now-area">
        @include('users.partials.book-now')
    </div>

    <section class="about-us-area">
        <div class="container">
            @yield('content')
        </div>
    </section>

    <section class="pool-area section-padding-100 bg-img bg-fixed" style="background-image: url({{ url('/user/img/bg-img/4.png') }});">
        @yield('pool-area')
    </section>

    <section class="rooms-area section-padding-100-0">
        <div class="container">
            @yield('room-area');
        </div>
    </section>

    <footer class="footer-area">
        <div class="container">
            <div class="row">

                <!-- Footer Widget Area -->
                <div class="col-12 col-lg-5">
                    <div class="footer-widget-area mt-50">
                        <a href="#" class="d-block mb-5"><img src="{{ asset('user/img/core-img/logo.png') }}" alt=""></a>
                        <p>Sistem ini diarahkan untuk memastikan bahwa tersedia pilihan tempat menginap terbaik di wilayah Mojokerto, dengan tujuan untuk meningkatkan tingkat kepuasan pelanggan melalui layanan yang komprehensif dan berkualitas.</p>
                    </div>
                </div>

                <!-- Footer Widget Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="footer-widget-area mt-50">
                        <h6 class="widget-title mb-5">Find us on the map</h6>
                        <img class="styled-map" src="{{ asset('user/img/bg-img/Indonesia_Mojokerto_Regency_location_map.png') }}" alt="Map of Mojokerto Regency">
                    </div>
                </div>

                <!-- Footer Widget Area -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="footer-widget-area mt-50">
                        <h6 class="widget-title mb-5">Send us your feedback</h6>
                        <form action="{{ route('sendEmail') }}" method="POST" class="subscribe-form">
                            @csrf
                            <input type="text" name="name" id="name" placeholder="Your Name" required>
                            <input type="email" name="email" id="email" placeholder="Your E-mail" required>
                            <textarea name="message" id="message" cols="30" rows="5" placeholder="Your Message" required></textarea>
                            <button type="submit">Send</button>
                        </form>
                    </div>
                </div>

                <!-- Copywrite Text -->
                <div class="col-12">
                    <div class="copywrite-text mt-30">
                        <p><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <script src="{{ asset('user/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/js/plugins/plugins.js') }}"></script>
    <script src="{{ asset('user/js/active.js') }}"></script>
    <script>@yield('script')</script>
</body>

</html>
