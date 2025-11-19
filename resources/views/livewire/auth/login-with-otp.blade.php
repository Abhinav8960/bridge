<div>
    @if ($desktopResult)
        <div class="container">
            <div class="login-page login-otp-contain mt-5 mb-5">
                <div class="login-left-box d-flex">
                    <div class="login-left">
                        <div class="inner_center">
                            <h3>Welcome Back to <span>Skoodos Bridge!</span></h3>
                            <p>A Connection Between Student & Institutes</p>
                            <form method="post" class="login_form" data-group-name="digits" data-autosubmit="false"
                                autocomplete="off" action="{{ route('student.auth.with.otp') }}">
                                @csrf
                                <div class="login_otp">
                                    <h6>Login With OTP</h6>
                                    @if ($isOtpSendButtonActive)
                                        <button type="button" class="btn btn-link" wire:click="sendOtp()">Send
                                            OTP</button>
                                    @endif
                                </div>
                                <div class="login_input">
                                    <input name="phone" type="text" maxlength="10"
                                        class="form-control @error('phone') is-invalid @enderror" id="mobile"
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                        onpaste="return false" placeholder="Mobile" required wire:model="phone"
                                        @if ($isOtpSend)
                                    readonly
    @endif>
    @error('phone')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

</div>
@if ($isOtpSend)
    <div class="otp_input digit-group">
        <input type="text" id="digit-1" wire:model="digitOne" name="digit-1" data-next="digit-2" />
        <input type="text" id="digit-2" wire:model="digitTwo" name="digit-2" data-next="digit-3"
            data-previous="digit-1" />
        <input type="text" id="digit-3" wire:model="digitThree" name="digit-3" data-next="digit-4"
            data-previous="digit-2" />
        <input type="text" id="digit-4" wire:model="digitFour" name="digit-4" data-next="digit-5"
            data-previous="digit-3" />
        <input type="text" id="digit-5" wire:model="digitFive" name="digit-5" data-next="digit-6"
            data-previous="digit-4" />
        <input type="text" id="digit-6" wire:model="digitSix" name="digit-6" data-previous="digit-5" />
    </div>
    @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
@endif
<input type="hidden" name="otp" value="{{ $enteredOtp }}">
<div class="login_forgot">
    <p>
        @if ($isOtpReSendButtonActive)
            <button type="button" class="btn btn-link" wire:click="resendOtp()">Resend
                OTP</button>
        @endif


        @if ($isOtpSend && !$isOtpReSendButtonActive)
            <span id="countdowntimer" wire:poll.1000ms>
                {{ $this->timerCountDown() }}
            </span>
        @endif
    </p>
    @if (Route::has('student.login'))
        <a class="btn btn-link" href="{{ route('student.login') }}">
            {{ __('Login with Password?') }}
        </a>
    @endif

</div>
<div class="login_buttons">
    {{-- <button type="submit" class="yellow-btn" @if ($isFormValid) @else disabled @endif>Login</button> --}}
    <button type="submit" class="btn"
        @if ($isFormValid) style="display:block;background-color: var(--yellow);
                            color: var(--primary);border: none;padding: 10px 64px;border-radius: 12px;font-size: 18px;"@else style="display:none;" @endif>Login</button>
    <span class="text-muted">New User?</span>
    @if (Route::has('student.register'))
        <a class="btn btn-link" href="{{ route('student.register') }}">
            {{ __('Register') }}
        </a>
    @endif

</div>
</form>
</div>
</div>
</div>
<div class="login-right-box ">
    <div class="login-right-bg text-center">
        <img src="/assets/skoodos/assets/img/login-banner.png" alt="">
        <h2>We are connect with <span>limitless Institutes</span> across India.</h2>
    </div>
</div>
</div>
</div>
@elseif($mobileResult)
<div class="container">
    <div class="auth__content">
        <div class="d-flex justify-content-between">
            @if (Route::has('student.login'))
                <a href="{{ route('student.login') }}">Login with Password</a>
            @endif
            <p><span class="text-muted">New User?</span>
                @if (Route::has('student.register'))
                    <a href="{{ route('student.register') }}">
                        Register
                    </a>
                @endif
            </p>
        </div>
        <div class="auth__content__heading">
            <h1>Welcome Back to <span>Skoodos Bridge!</span></h1>
            <p>A Connection Between Student & Institutes</p>
        </div>
        <div class="auth__content__text">
            <div class="d-flex justify-content-between">
                <h2>Login With OTP</h2>
                @if ($isOtpSendButtonActive)
                    <button type="button" class="btn btn-link" wire:click="sendOtp()">Send
                        OTP</button>
                @endif
            </div>

            <form method="post" class="login_form" data-group-name="digits" data-autosubmit="false" autocomplete="off"
                action="{{ route('student.auth.with.otp') }}">
                @csrf
                <div class="mb-4">
                    <input name="phone" type="text" maxlength="10"
                        class="form-control @error('phone') is-invalid @enderror" id="mobile"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false"
                        placeholder="Mobile" required wire:model="phone" @if ($isOtpSend)
                    readonly
                    @endif>
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                @if ($isOtpSend)
                    <div class="mb-4">

                        <div class="otp_input digit-group">
                            <input type="text" id="digit-1" wire:model="digitOne" name="digit-1"
                                data-next="digit-2" />
                            <input type="text" id="digit-2" wire:model="digitTwo" name="digit-2"
                                data-next="digit-3" data-previous="digit-1" />
                            <input type="text" id="digit-3" wire:model="digitThree" name="digit-3"
                                data-next="digit-4" data-previous="digit-2" />
                            <input type="text" id="digit-4" wire:model="digitFour" name="digit-4"
                                data-next="digit-5" data-previous="digit-3" />
                            <input type="text" id="digit-5" wire:model="digitFive" name="digit-5"
                                data-next="digit-6" data-previous="digit-4" />
                            <input type="text" id="digit-6" wire:model="digitSix" name="digit-6"
                                data-previous="digit-5" />
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                <input type="hidden" name="otp" value="{{ $enteredOtp }}">
                <div class="otp--timer mb-4 text-center">
                    <p>
                        @if ($isOtpReSendButtonActive)
                            {{-- <a href="javascript:void(0)" onclick="timer();">Resend
                                OTP</a> --}}
                            <button type="button" class="btn btn-link" wire:click="resendOtp()">Resend
                                OTP</button>
                        @endif


                        @if ($isOtpSend && !$isOtpReSendButtonActive)
                            <span id="countdowntimer" wire:poll.1000ms>
                                {{ $this->timerCountDown() }}
                            </span>
                        @endif
                    </p>

                </div>
                <div class="auth-btn-wrapper" style="text-align: center;">
                    <button type="submit" class="btn"
                        @if ($isFormValid) @else style="display:none;" @endif>Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
    <script>
        document.addEventListener('livewire:load', function(event) {


            Livewire.hook('message.processed', () => {

                $('.digit-group').find('input').each(function() {
                    $(this).attr('maxlength', 1);
                    $(this).on('keyup', function(e) {
                        var parent = $($(this).parent());

                        if (e.keyCode === 8 || e.keyCode === 37) {
                            var prev = parent.find('input#' + $(this).data('previous'));

                            if (prev.length) {
                                $(prev).select();
                            }
                        } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >=
                                65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <=
                                105) || e.keyCode === 39 || e.keyCode == 229) {
                            var next = parent.find('input#' + $(this).data('next'));

                            if (next.length) {
                                $(next).select();
                            } else {
                                if (parent.data('autosubmit')) {
                                    parent.submit();
                                }
                            }
                        }
                    });
                });

            });



        });
    </script>
</div>
