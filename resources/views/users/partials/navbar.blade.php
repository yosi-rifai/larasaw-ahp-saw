<!-- Navbar Area -->
<div class="palatin-main-menu">
    <div class="classy-nav-container breakpoint-off">
        <div class="container">
            <!-- Menu -->
            <nav class="classy-navbar justify-content-between" id="palatinNav">
                <a href="{{ url('/') }}" class="nav-brand"><img src="{{ asset('user/img/core-img/favicon.ico') }}" alt=""></a>
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <!-- Menu -->
                <div class="classy-menu">

                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li class="{{ Request::is('/') ? 'active' : '' }}">
                                <a href="{{ url('/') }}" class="nav-link">
                                    <span>Home</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('hotelspage') ? 'active' : '' }}">
                                <a href="{{ url('/hotelspage') }}" class="nav-link">
                                    <span>Hotels</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('about') ? 'active' : '' }}">
                                <a href="{{ url('/about') }}" class="nav-link">
                                    <span>About Us</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}" class="nav-link">
                                    <span>Login</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
