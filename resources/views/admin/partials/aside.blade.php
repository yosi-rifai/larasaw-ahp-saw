<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <hr class="horizontal light mt-0 mb-2">
    <div class="text-center my-3">
        @auth
            <img src="{{ Auth::user()->profile_image ? asset('images/profiles/'.Auth::user()->profile_image_url) : asset('images/default_image/user.jpg') }}" class="rounded-circle" alt="Profile Image" style="width: 100px; height: 100px;">
            <div class="text-white mt-2">
                <span class="badge bg-success">Online</span>
                <h6 class="badge bg-primary text-wrap">{{ Auth::user()->name }}</h6>
            </div>
        @else
            <img src="default-profile-image-url.jpg" class="rounded-circle" alt="Profile Image" style="width: 100px; height: 100px;">
            <div class="text-white mt-2">
                <span class="badge bg-secondary">Offline</span>
                <h6 class="mt-2">Guest</h6>
            </div>
        @endauth
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                    DATA
                </h6>
              </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('hotels.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">hotel</i>
                    </div>
                    <span class="nav-link-text ms-1">Hotel</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('criterias.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">checklist</i>
                    </div>
                    <span class="nav-link-text ms-1">Criteria</span>
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">RANKING</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('alternatives.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">compare</i>
                    </div>
                    <span class="nav-link-text ms-1">Result Alternative SAW</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('rankings.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assessment</i>
                    </div>
                    <span class="nav-link-text ms-1">Result Final AHP</span>
                </a>
            </li>
            <hr class="horizontal light mt-0 mb-2">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('profile.show') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">settings</i>
                    </div>
                    <span class="nav-link-text ms-1">Profile Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a class="nav-link text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">logout</i>
                        </div>
                        <span class="nav-link-text ms-1">Logout</span>
                </form>
                </a>
            </li>
        </ul>
    </div>
    </div>
</aside>
