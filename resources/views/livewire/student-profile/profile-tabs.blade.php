<div>
    @if ($desktopResult)
        <!-- ----------- Wish List -------- -->
        <section class="wish-list">
            <div class="wish-list__tab">
                <div class="container">
                    <ul class="nav nav-pills mt-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if ($isShowWishlist) active @endif " id="pills-wish-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-wish" type="button" role="tab"
                                aria-controls="pills-wish" aria-selected="true" wire:click="activeWishlist()">My Wish
                                List
                                <span>({{ $wishlistCount }})</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if ($isShowEnroll) active @endif"
                                id="pills-enroll-tab" data-bs-toggle="pill" data-bs-target="#pills-enroll"
                                type="button" role="tab" aria-controls="pills-enroll" aria-selected="true"
                                wire:click="activeEnroll()">My Enrolled
                                Course
                                <span>({{ $entrollCount }})</span> </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link  @if ($isShowChangespassword) active @endif"
                                id="pills-change-password-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-change-password" type="button" role="tab"
                                aria-controls="pills-change-password" aria-selected="true"
                                wire:click="activeChangesPassword()">Manage Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link  @if ($isShowDeleteProfile) active @endif"
                                id="pills-change-password-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-change-password" type="button" role="tab"
                                aria-controls="pills-change-password" aria-selected="true"
                                wire:click="activeDeleteProfile()">Delete Profile</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="tab-content" id="pills-tabContent">

                    @if ($isShowWishlist)
                        @livewire('student-profile.profile.wishlist')
                    @endif
                    @if ($isShowEnroll)
                        @livewire('student-profile.profile.enroll-course')
                        {{-- @livewire('student-profile.profile.enroll-course', ['enrollment' => $enrollment]) --}}
                    @endif

                    @if ($isShowChangespassword)
                        @livewire('student-profile.profile.changes-password')
                    @endif

                    @if ($isShowDeleteProfile)
                        @livewire('student-profile.profile.delete-profile')
                    @endif

                </div>
            </div>
        </section>
    @elseif($mobileResult)
        @livewire('student-profile.profile.changes-password')
        <!-- --------- End Change Password ------- -->

        <section class="profile-link">
            <div class="container">
                <a href="{{ route('student.wishlist') }}">
                    <p> My Wish List <span>({{ $wishlistCount }})</span></p> <i class="bi bi-arrow-right"></i>
                </a>
                <a wire:click="activeMobileEnroll()">
                    <p> My Enrolled Course <span>({{ $entrollCount }})</span></p> <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </section>
    @endif
</div>
