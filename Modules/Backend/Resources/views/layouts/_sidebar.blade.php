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
                <li class="side-item side-item-category">Main</li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="/public">
                        <img src="/assets/img/backend-menu-icon/Icons_Dashboard-a.png" class="img-responsive"
                            width="30px">
                        <span class="side-menu__label">Dashboard</span></a>

                </li>
                @isRoles([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_MANAGER])
                    <li class="slide">
                        <a class="side-menu__item @if (Route::is('configuration.*')) active @endif" data-bs-toggle="slide"
                            href="javascript:void(0);">
                            <img src="/assets/img/backend-menu-icon/Icons_Configuration-a.png" class="img-responsive"
                                width="30px">
                            <span class="side-menu__label">Configuration</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu @if (Route::is('configuration.*')) open d-block @endif">
                            <li><a class="slide-item @if (Route::is('configuration.category.*')) active @endif"
                                    href="{{ route('configuration.category.index') }}">Exam Category</a>
                            </li>
                            <li><a class="slide-item @if (Route::is('configuration.parameter.*')) active @endif"
                                    href="{{ route('configuration.parameter.index') }}">Parameters</a>
                            </li>
                            <li><a class="slide-item @if (Route::is('configuration.stream.*')) active @endif"
                                    href="{{ route('configuration.stream.index') }}">Exam Stream </a></li>
                            <li><a class="slide-item @if (Route::is('configuration.exam.*')) active @endif"
                                    href="{{ route('configuration.exam.index') }}">Exam</a></li>
                            <li><a class="slide-item @if (Route::is('configuration.feature.*')) active @endif"
                                    href="{{ route('configuration.feature.index') }}">Institute Feature</a></li>
                            <li><a class="slide-item @if (Route::is('configuration.calltoaction.*')) active @endif"
                                    href="{{ route('configuration.calltoaction.index') }}">Call To Action</a></li>
                            <li><a class="slide-item @if (Route::is('configuration.faqcategory.*')) active @endif"
                                    href="{{ route('configuration.faqcategory.index') }}">Faq Category</a></li>
                            <li><a class="slide-item @if (Route::is('configuration.faq.*')) active @endif"
                                    href="{{ route('configuration.faq.index') }}">Faq</a></li>
                            <li><a class="slide-item @if (Route::is('configuration.privacypolicy.*')) active @endif"
                                    href="{{ route('configuration.privacypolicy.index') }}">Privacy Policy</a></li>
                            <li><a class="slide-item @if (Route::is('configuration.termanduse.*')) active @endif"
                                    href="{{ route('configuration.termanduse.index') }}">Term And Use</a></li>


                        </ul>

                    </li>
                    <li class="slide">
                        <a class="side-menu__item @if (Route::is('popularcity.*')) active @endif" data-bs-toggle="slide"
                            href="{{ route('popularcity.index') }}">
                            <img src="/assets/img/backend-menu-icon/Icons_Popular Cities-a.png" class="img-responsive"
                                width="30px">
                            <span class="side-menu__label">Popular Cities</span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item @if (Route::is('enrollments')) active @endif" data-bs-toggle="slide"
                            href="{{ route('enrollments') }}">
                            <img src="/assets/img/backend-menu-icon/Icons_Enrollment-a.png" class="img-responsive"
                                width="30px">
                            <span class="side-menu__label">Enrollments</span></a>

                    </li>
                    <li class="slide">
                        <a class="side-menu__item @if (Route::is('payment.*')) active @endif" data-bs-toggle="slide"
                            href="javascript:void(0);">
                            <img src="/assets/img/backend-menu-icon/Icons_Payment-a.png" class="img-responsive"
                                width="30px">
                            <span class="side-menu__label">Payments</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu @if (Route::is('payment.*')) open d-block @endif">
                            @isRoles([\App\Models\User::ROLE_ADMIN])
                                <li><a class="slide-item @if (Route::is('payment.tax.*')) active @endif"
                                        href="{{ route('payment.tax.index') }}">Taxation</a>
                                </li>
                                <li><a class="slide-item @if (Route::is('payment.saccode.*')) active @endif"
                                        href="{{ route('payment.saccode.index') }}">Billing SAC Code</a>
                                </li>
                                <li><a class="slide-item @if (Route::is('payment.billingaccount.*')) active @endif"
                                        href="{{ route('payment.billingaccount.index') }}">Billing Account</a>
                                </li>
                            @endisRoles

                            <li><a class="slide-item @if (Route::is('payment.report.success')) active @endif"
                                    href="{{ route('payment.report.success') }}">Success</a>
                            </li>
                            <li><a class="slide-item @if (Route::is('payment.report.failed')) active @endif"
                                    href="{{ route('payment.report.failed') }}">Failed</a></li>
                            @isRoles([\App\Models\User::ROLE_ADMIN])
                                <li><a class="slide-item @if (Route::is('payment.report.refund')) active @endif"
                                        href="{{ route('payment.report.refund') }}">Refund</a></li>
                            @endisRoles



                        </ul>

                    </li>
                @endisRoles
                @isRoles([\App\Models\User::ROLE_ADMIN])
                    <li class="slide">
                        <a class="side-menu__item @if (Route::is('userregistration.index')) active @endif" data-bs-toggle="slide"
                            href="{{ route('userregistration.index') }}">
                            <img src="/assets/img/backend-menu-icon/Icons_Roles-a.png" class="img-responsive"
                                width="30px">

                            <span class="side-menu__label">Roles</span></a>
                    </li>
                @endisRoles


                @isRoles([\App\Models\User::ROLE_ADMIN])
                    <li class="slide">
                        <a class="side-menu__item @if (Route::is('packages.*')) active @endif"
                            data-bs-toggle="slide" href="{{ route('packages.index') }}">
                            <img src="/assets/img/backend-menu-icon/Icons_Packages-a.png" class="img-responsive"
                                width="30px">

                            <span class="side-menu__label">Packages</span></a>
                    </li>
                @endisRoles


                @isRoles([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_MANAGER, \App\Models\User::ROLE_SEEDER])
                    <li class="slide">
                        <a class="side-menu__item @if (Route::is('institute.*')) active @endif"
                            data-bs-toggle="slide" href="javascript:void(0);">
                            <img src="/assets/img/backend-menu-icon/Icons_Institutes-a.png" class="img-responsive"
                                width="30px">

                            <span class="side-menu__label">Institutes</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu @if (Route::is('institute.*')) open d-block @endif">
                            <li><a class="slide-item @if (Route::is('institute.index*')) active @endif"
                                    href="{{ route('institute.index') }}">Listing</a>
                            </li>
                            <li><a class="slide-item @if (Route::is('institute.feature.*')) active @endif"
                                    href="{{ route('institute.feature.index') }}">Featured</a></li>

                            <li><a class="slide-item @if (Route::is('institute.leaderboard.*')) active @endif"
                                    href="{{ route('institute.leaderboard.index') }}">Leaderboard</a></li>

                        </ul>
                    </li>
                @endisRoles

                @isRoles([\App\Models\User::ROLE_ADMIN])
                    <li class="slide">
                        <a class="side-menu__item @if (Route::is('spotlites.index')) active @endif"
                            data-bs-toggle="slide" href="{{ route('spotlites.index') }}">
                            <img src="/assets/img/backend-menu-icon/Icons_Roles-a.png" class="img-responsive"
                                width="30px">

                            <span class="side-menu__label">Spotlite</span></a>
                    </li>
                @endisRoles

                @isRoles([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_MANAGER, \App\Models\User::ROLE_BlOGGER])
                    <li class="slide">
                        <a class="side-menu__item @if (Route::is('blog.*')) active @endif"
                            data-bs-toggle="slide" href="javascript:void(0);">
                            <img src="/assets/img/backend-menu-icon/Icons_Blog-a.png" class="img-responsive"
                                width="30px">

                            <span class="side-menu__label">Blog</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu @if (Route::is('blog.*')) open d-block @endif">
                            <li><a class="slide-item @if (Route::is('blog-dashboard.*')) active @endif"
                                    href="{{ route('blog.dashboard.index') }}">Dashboard </a> </li>

                    </li>
                    <li><a class="slide-item @if (Route::is('blog.index*')) active @endif"
                            href="{{ route('blog.index') }}">All Blogs </a>
                    </li>
                    <li><a class="slide-item @if (Route::is('blog-category.*')) active @endif"
                            href="{{ route('blog.category.index') }}">Categories</a></li>


                    <li><a class="slide-item @if (Route::is('blog-approval-queue.*')) active @endif"
                            href="{{ route('approvalqueue') }}">Approval Queue</a></li>
                @endisRoles


                {{-- <li><a class="slide-item @if (Route::is('institute.leaderboard.*')) active @endif"
                                href="{{ route('institute.leaderboard.index') }}">Dashboard</a></li> --}}

            </ul>
            </li>

            @isRoles([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_MANAGER])
                <li class="slide">
                    <a class="side-menu__item @if (Route::is('leads.*')) active @endif" data-bs-toggle="slide"
                        href="javascript:void(0);">
                        <img src="/assets/img/backend-menu-icon/Icons_Leads-a.png" class="img-responsive" width="30px">

                        <span class="side-menu__label">Leads</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu @if (Route::is('leads.*')) open d-block @endif">


                        <li><a class="slide-item @if (Route::is('leads.contact.list')) active @endif"
                                href="{{ route('leads.contact.list') }}">Contact</a>
                        </li>

                        <li><a class="slide-item @if (Route::is('leads.enroll.list')) active @endif"
                                href="{{ route('leads.enroll.list') }}">Enroll</a>
                        </li>
                    </ul>
                @endisRoles

                @isRoles([\App\Models\User::ROLE_ADMIN])
                <li class="slide">
                    <a class="side-menu__item @if (Route::is('students.*')) active @endif" data-bs-toggle="slide"
                        href="{{ route('students.index') }}">
                        <img src="/assets/img/backend-menu-icon/Icons_Registered User-a.png" class="img-responsive"
                            width="30px">

                        <span class="side-menu__label">Users</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item @if (Route::is('sms.*')) active @endif" data-bs-toggle="slide"
                        href="javascript:void(0);">
                        <img src="/assets/img/backend-menu-icon/Icons_Leads-a.png" class="img-responsive" width="30px">

                        <span class="side-menu__label">Logs</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu @if (Route::is('sms.*')) open d-block @endif">


                        <li><a class="slide-item @if (Route::is('sms.log')) active @endif"
                                href="{{ route('sms.log') }}">Sms Log</a>
                        </li>
                        <li><a class="slide-item @if (Route::is('redirectIndex')) active @endif"
                                href="{{ route('redirectIndex') }}">Redirects</a></li>

                    </ul>
                </li>
            @endisRoles

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
