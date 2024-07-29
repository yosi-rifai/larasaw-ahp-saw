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
            max-width: 600px;
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
<div class="bg-image-vertical" style="background-image: url('{{ asset('auth/aston-mojokerto.jpg') }}');"></div>
<div class="container-fluid h-custom-2">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-md-8 card-container">
            <div class="card login-card">
                @include('modals.error')
                <form id="registerForm" action="{{ route('register') }}" method="POST">
                    @csrf
                    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register</h3>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="username">Username</label>
                                <input name="name" type="text" id="username" class="form-control form-control-lg" />
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="email">Email address</label>
                                <input name="email" type="email" id="email" class="form-control form-control-lg" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group">
                                    <input name="password" type="password" id="password" class="form-control form-control-lg" />
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div data-mdb-input-init class="form-outline">
                                <label class="form-label" for="confirmPassword">Confirm Password</label>
                                <div class="input-group">
                                    <input name="password_confirmation" type="password" id="confirmPassword" class="form-control form-control-lg" />
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword2">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <small id="passwordHelp" class="form-text text-muted" style="display:none;">Passwords do not match!</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button id="registerButton" data-mdb-button-init data-mdb-ripple-init class="btn palatin-btn" type="submit">Register</button>
                    </div>
                    <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
      var passwordInput = document.getElementById('password');
      var confirmPasswordInput = document.getElementById('confirmPassword');
      var passwordHelp = document.getElementById('passwordHelp');
      var registerButton = document.getElementById('registerButton');
      var registerForm = document.getElementById('registerForm');

      var togglePassword1 = document.getElementById('togglePassword1');
      var togglePassword2 = document.getElementById('togglePassword2');

      togglePassword1.addEventListener('click', function () {
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
      });

      togglePassword2.addEventListener('click', function () {
        var type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
      });

      function validatePasswords() {
        if (confirmPasswordInput.value !== passwordInput.value) {
          passwordHelp.style.display = 'block';
          registerButton.disabled = true;
        } else {
          passwordHelp.style.display = 'none';
          registerButton.disabled = false;
        }
      }

      confirmPasswordInput.addEventListener('input', validatePasswords);
      passwordInput.addEventListener('input', validatePasswords);

      registerForm.addEventListener('submit', function(event) {
        if (passwordInput.value !== confirmPasswordInput.value) {
          event.preventDefault();
          passwordHelp.style.display = 'block';
        }
      });
    });
  </script>
