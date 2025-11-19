@if ($desktopResult)
    <div>
        <div class="tab-pane fade  show active" id="pills-change-password" role="tabpanel"
            aria-labelledby="pills-change-password-tab">
            <div class="change-password">
                <div class="row">
                    <div class="col-lg-4 ">
                        <div class="border-right">
                            <h2>Personal Details</h2>

                            <ul>
                                <li>
                                    <span><i class="bi bi-telephone-fill"></i></span>+91-{{ $user->phone }}
                                </li>
                                <li>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i
                                                class="bi bi-person-fill text-center"></i></span>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Name*" required wire:model="name">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </li>
                                <li>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i
                                                class="bi bi-envelope-fill text-center"></i></span>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="email*" required wire:model="email">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        @include('layouts.flash-message')

                        <form wire:submit.prevent="submit">
                            <div class="mb-4">
                                <input type="password" class="form-control" id="current_password"
                                    name="current_password" placeholder="Current Password*" required
                                    wire:model="current_password">
                                @error('current_password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="New Password*" required wire:model="password">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="password" class="form-control" id="confirm_password"
                                    name="password_confirmation" placeholder="Confirm Password*" required
                                    wire:model="password_confirmation">
                                @error('password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class=" text-end">
                                <button class="yellow-btn mt-2" type="submit">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($mobileResult)
    <main>

        <!-- ------- Sub Header ----- -->

        <header class="sub-header">
            <div class="container">
                <div class="row">
                    <a href="/"><i class="bi bi-arrow-left"></i>My Profile</a>
                </div>
            </div>
        </header>

        <!-- ------- Sub Header ----- -->

        <!-- ------------ Profile Detials ------------- -->

        <section class="profile-details">
            <div class="container">
                <div class="row">
                    <h2>Personal Details</h2>
                    <h3>{{ $user->name }}</h3>
                    <ul>
                        <li><span><i class="bi bi-telephone-fill"></i></span>+91-{{ $user->phone }}</li>
                        <li><span><i class="bi bi-envelope-fill"></i></span>{{ $user->email }}</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- ------------ Change Password  ------------- -->

        <section class="change-password">
            <div class="container">
                <div class="change-password ">
                    <form wire:submit.prevent="submit">
                        <div class="mb-4">
                            <input type="password" class="form-control" id="current_password" name="current_password"
                                placeholder="Current Password*" required wire:model="current_password">
                            @error('current_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="New Password*" required wire:model="password">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="password" class="form-control" id="confirm_password"
                                name="password_confirmation" placeholder="Confirm Password*" required
                                wire:model="password_confirmation">
                            @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button class="btn-yellow mt-2" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endif
