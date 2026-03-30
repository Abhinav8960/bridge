@IsIntitutesuspended
        <div id="overlay" style="display: block">
            <div id="text">
               
                Your account is suspended, kindly please contact support for further help.

                <div class="text-end">
                    <a class="btn btn-danger" href="{{ route('institute.logout') }}"
                        onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>
            </div>

            <form id="logout-form" action="{{ route('institute.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <style>
            #overlay {
                position: fixed;
                display: none;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgb(0 0 0 / 82%);
                z-index: 2;
                cursor: pointer;
            }

            #text {
                position: absolute;
                top: 50%;
                left: 50%;
                font-size: 20px;
                color: white;
                transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
            }
        </style>
   
@endIsIntitutesuspended

@IsIntituteexpire
        <div id="overlay" style="display: block">
            <div id="text">
                
                Your account is Expired, kindly please contact support for further help.

                <div class="text-end">
                    <a class="btn btn-danger" href="{{ route('institute.logout') }}"
                        onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>
            </div>

            <form id="logout-form" action="{{ route('institute.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <style>
            #overlay {
                position: fixed;
                display: none;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgb(0 0 0 / 82%);
                z-index: 2;
                cursor: pointer;
            }

            #text {
                position: absolute;
                top: 50%;
                left: 50%;
                font-size: 20px;
                color: white;
                transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
            }
        </style>
   
@endIsIntituteexpire
