@extends('auth.layout.main')

@section('style')
    <style>
        .bg-image-vertical {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            filter: blur(8px);
            z-index: -1;
        }

        .h-custom-2 {
            height: 100vh;
        }

        .card-container {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            max-width: 550px;
            width: 100%;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        a:hover {
            color: #a35e48;
            cursor: pointer;
        }

        .form-control:hover {
            border-color: #eba38d;
        }

        .form-control:focus {
            border-color: #eba38d;
            box-shadow: 0 0 0 0.2rem rgba(235, 163, 141, 0.25);
        }
    </style>
@endsection

@section('content')
<div class="bg-image-vertical" style="background-image: url('{{ asset('auth/ayola_hotel.jpg') }}');"></div>
<div class="container-fluid h-custom-2">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-md-8 card-container">
            <div class="card login-card">
                @include('modals.error')
                <div class="mb-4 text-center">
                    <img src="{{ asset('user/img/core-img/favicon.ico') }}" alt="Favicon">
                    <a class="h3 text-decoration-none link-dark" href="{{ route('homepage') }}">Staycation Recommendation</a>
                </div>

                <div class="footer-widget-area">
                    <form action="{{ route('login') }}" method="POST" class="subscribe-form">
                        @csrf
                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="form2Example18">Email address</label>
                            <input name="email" type="email" id="form2Example18" class="form-control form-control-lg" />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="form2Example28">Password</label>
                            <input name="password" type="password" id="form2Example28" class="form-control form-control-lg" />
                        </div>

                        {{-- <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p> --}}
                        <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button data-mdb-button-init data-mdb-ripple-init class="btn palatin-btn m-2" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
