<!-- main-sidebar -->
<div class="sticky">
    <aside class="app-sidebar">
        <div class="main-sidebar-header active">
            <a class="header-logo active" href="index.html">

                <img src="/assets/img/faces/Logo.png" class="main-logo  desktop-logo" alt="logo">

            </a>
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>

            <ul class="side-menu">

                @if (session()->has('institute.name'))
                    <li class="slide">
                        <div class="side-menu__item"><span
                                class="side-menu__label">{{ session()->get('institute.name') }}</span></div>

                    </li>
                @endif
                <li class="side-item side-item-category">Main</li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('institute.public') }}">
                        <img src="/assets/img/backend-menu-icon/Icons_Dashboard-a.png" class="img-responsive"
                            width="30px">
                        <span class="side-menu__label">Dashboard</span></a>

                </li>
                <li class="slide">
                    <a class="side-menu__item @if (Route::is('institute.streams.index')) active @endif" data-bs-toggle="slide"
                        href="{{ route('institute.streams.index') }}">
                        <img src="/assets/img/backend-menu-icon/Icons_Streams-a.png" class="img-responsive"
                            width="30px">
                        <span class="side-menu__label">Streams</span></a>

                </li>
                @isTabAccessable('is_showing_centers')
                    <li class="slide">
                        <a class="side-menu__item @if (Route::is('center.*')) active @endif" data-bs-toggle="slide"
                            href="{{ route('center.index') }}">
                            <img src="/assets/img/backend-menu-icon/Icons_Centers-a.png" class="img-responsive"
                                width="30px">
                            <span class="side-menu__label">Centers</span></a>

                    </li>
                @endisTabAccessable

                <li class="slide">
                    <a class="side-menu__item @if (Route::is('information.*')) active @endif" data-bs-toggle="slide"
                        href="javascript:void(0);">
                        <img src="/assets/img/backend-menu-icon/Icons_Info-a.png" class="img-responsive" width="30px">

                        <span class="side-menu__label">Information</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu @if (Route::is('information.*')) open d-block @endif">
                        @isTabAccessable('is_showing_general')
                            <li><a class="slide-item @if (Route::is('information.general')) active @endif"
                                    href="{{ route('information.general') }}">General</a>
                            </li>
                        @endisTabAccessable
                        @isTabAccessable('is_showing_courses')
                            <li><a class="slide-item @if (Route::is('information.course.*')) active @endif"
                                    href="{{ route('information.course.index') }}">Courses</a>
                            </li>
                        @endisTabAccessable
                        @isTabAccessable('is_showing_champions')
                            <li><a class="slide-item @if (Route::is('information.champions.*')) active @endif"
                                    href="{{ route('information.champions.index') }}">Champions</a>
                            </li>
                        @endisTabAccessable
                        @isTabAccessable('is_showing_uploads')
                            <li><a class="slide-item @if (Route::is('information.uploads')) active @endif"
                                    href="{{ route('information.uploads') }}">Uploads</a>
                            </li>
                        @endisTabAccessable
                        @isTabAccessable('is_showing_faculty')
                            <li><a class="slide-item @if (Route::is('information.faculty.*')) active @endif"
                                    href="{{ route('information.faculty.index') }}">Faculty</a>
                            </li>
                        @endisTabAccessable
                        {{-- @isTabAccessable('is_showing_centers')
                            <li><a class="slide-item @if (Route::is('information.center.*')) active @endif"
                                    href="{{ route('information.center.index') }}">Centers</a>
                            </li>
                        @endisTabAccessable --}}
                        @isTabAccessable('is_showing_videos')
                            <li><a class="slide-item @if (Route::is('information.video.*')) active @endif"
                                    href="{{ route('information.video.index') }}">Videos</a>
                            </li>
                        @endisTabAccessable
                        @isTabAccessable('is_showing_alumni')
                            <li><a class="slide-item @if (Route::is('information.alumni.*')) active @endif"
                                    href="{{ route('information.alumni.index') }}">Alumni</a>
                            </li>
                        @endisTabAccessable

                        <li>
                            <a class="slide-item @if (Route::is('information.publish.*')) active @endif"
                                href="{{ route('information.publish.index') }}">Publish</a>
                        </li>
                    </ul>
                </li>
                @if (Gate::allows('show-enroll'))
                    <li class="slide">
                        <a class="side-menu__item @if (Route::is('institute.enrollment')) active @endif"
                            data-bs-toggle="slide" href="{{ route('institute.enrollment') }}">
                            <img src="/assets/img/backend-menu-icon/Icons_Enrollment-a.png" class="img-responsive"
                                width="30px">
                            <span class="side-menu__label">Enrollments</span></a>

                    </li>
                @endif

                @isTabAccessable('is_showing_review')
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('institute.reviews') }}">

                            <img src="/assets/img/backend-menu-icon/Icons_Review-a.png" class="img-responsive"
                                width="30px">

                            <span class="side-menu__label">Reviews</span></a>

                    </li>
                @endisTabAccessable

                @isTabAccessable('is_showing_contact')
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('institute.leads') }}">
                            <img src="/assets/img/backend-menu-icon/Icons_Leads-a.png" class="img-responsive"
                                width="30px">

                            <span class="side-menu__label">Leads</span></a>

                    </li>
                @endisTabAccessable

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide"
                        href="{{ route('institute.microsite', ['slug' => session()->get('institute.slug')]) }}"
                        target="_blank">
                        <img src="/assets/img/backend-menu-icon/Icons_View Listing-a.png" class="img-responsive"
                            width="30px">

                        <span class="side-menu__label">View Listing</span></a>

                </li>
                @if (session()->has('isAdmin') && session()->has('admin') && session()->get('isAdmin') == true)
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide"
                            href="{{ route('institute.backToAdmin', ['user' => session()->get('admin'), 'isAdmin' => true]) }}">
                            <img src="/assets/img/backend-menu-icon/Icons_Back To Admin-a.png" class="img-responsive"
                                width="30px">

                            <span class="side-menu__label">Back to Admin</span></a>

                    </li>
                @endif
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('backend.logout') }}"
                        onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                        <img src="/assets/img/backend-menu-icon/Icons_LogOut-a.png" width="20px">
                        <span class="side-menu__label">Logout</span></a>
                    <form id="logout-form" action="{{ route('backend.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </li>
            </ul>
        </div>
    </aside>
</div>
<!-- main-sidebar -->
