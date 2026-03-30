<!-- ======= Header ======= -->
<header id="header" class="header fixed-top" style="background-color: rgb(255, 255, 255);">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ route('homepage') }}" class="logo d-flex align-items-center">
            <img src="/assets/skoodos/assets/img/homepage/UpperBanner/Logo.png" alt="">
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto  @if (Route::is('homepage')) active @endif"
                        href="{{ route('homepage') }}">Home</a></li>
                        <!-- http://spherionsolutions.com/about-us.html -->
                <li><a class="nav-link scrollto" href="{{ route('about') }}"
                        target="_blank">About</a></li>
                <li><a class="nav-link scrollto @if (Route::is('explore.*')) active @endif"
                        href="{{ route('explore.india') }}">Explore</a></li>
                {{-- <li><a class="nav-link scrollto @if (Route::is('compare.institute')) active @endif"
                        href="{{ route('compare.institute') }}">Compare</a></li> --}}
                <li class="dropdown @if (Route::is('exams.*')) active @endif"><a class="nav-link "
                        href="#"><span>Exams</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @isEntranceExam
                            <li class="@if (Route::is('exams.entrance-exam')) active @endif"><a
                                    href="{{ route('exams.entrance-exam') }}">Entrance Exams</a></li>
                        @endisEntranceExam
                        @isGovernmentExam
                            <li class="@if (Route::is('exams.government-exam')) active @endif"><a
                                    href="{{ route('exams.government-exam') }}">Government Exams</a></li>
                        @endisGovernmentExam
                        @isForeignExam<li class="@if (Route::is('exams.foreign-exam')) active @endif"><a
                                href="{{ route('exams.foreign-exam') }}">Foreign Language Exams</a></li>
                        @endisForeignExam
                    </ul>
                </li>
                <li><a class="nav-link scrollto @if (Route::is('enroll')) active @endif"
                        href="{{ route('enroll') }}">Enroll</a></li>
                {{-- @student --}}
                    <li><a class="nav-link scrollto  @if (Route::is('blog')) active @endif"
                            href="{{ route('blog') }}">Blog</a></li>
                {{-- @endstudent --}}

                <li><a class="nav-link scrollto @if (Route::is('faq')) active @endif"
                        href="{{ route('faq') }}">FAQ's</a></li>
                <li><a class="nav-link scrollto @if (Route::is('contact')) active @endif"
                        href="{{ route('contact') }}">Contact</a></li>
                <!-- <a href="login.html"><img src="assets/img/homepage/UpperBanner/login.png" alt=""></a> -->
                <li class="login-dd dropdown btn-group dropstart "><a href="#"><img
                            src="/assets/skoodos/assets/img/homepage/UpperBanner/Rounded Rectangle 1.png"
                            alt=""></a>
                    <ul class="dropdown-menu dropstart">
                        @student
                            <li><a class="nav-link" href="{{ route('student.logout') }}"
                                    onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">

                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('student.logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                            <li><a href="{{ route('student.profile') }}">My Profile </a></li>
                        @else
                            @if (Route::has('student.login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('student.login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('student.register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('student.register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endstudent
                    </ul>
                </li>
            </ul>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->
