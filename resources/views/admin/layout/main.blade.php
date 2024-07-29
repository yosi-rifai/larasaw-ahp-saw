<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/assets/img/apple-icon.png') }}">
    <link rel="icon" href="{{ asset('user/img/core-img/favicon.ico') }}">
    @php
        $currentSegment = request()->segment(count(request()->segments()));
        $pageTitle = ucfirst(str_replace('-', ' ', $currentSegment));
    @endphp
    <title>{{ $pageTitle }}</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="{{ asset('admin/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('admin/assets/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/jquery.multiselect.css') }}">
    @yield('style')
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar-example2" class="d-flex flex-column min-vh-100 g-sidenav-show  bg-gray-200">
    @include('admin.partials.aside')
    <main id="topMain" class="main-content border-radius-lg ">
        @include('admin.partials.navbar')
        <div class="container flex-grow-1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                    @yield('content')
                    </div>
                </div>
            </div>
            @include('admin.partials.footer')
        </div>
    </main>

    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">settings</i>
          </a>
        <div class="card shadow-lg">
          <div class="card-header pb-0 pt-3">
            <div class="float-start">
              <h5 class="mt-3 mb-0">ADMIN THEME CONFIG</h5>
              <p>See our panel options.</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="material-icons">clear</i>
                </button>
            </div>
          </div>
            @include('admin.partials.theme_config')
           </div>
        </div>
</body>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('admin/assets/js/core/popper.min.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="{{ asset('admin/assets/js/jquery.multiselect.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/plugins/smooth-scrollbar.min.js') }}" ></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('admin/assets/js/material-dashboard.min.js?v=3.1.0') }}"></script>

    <script>
        @yield('script')
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
          var options = {
            damping: '0.5'
          }
          Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
</html>
