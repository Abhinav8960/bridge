<div>
    <ul>
        @foreach ($callToAction as $action)
        {{-- @dd($action); --}}
            @if ($action->is_showin_footer == 1)
                @if ($action->call_to_action_type == 1)
                    <li> <a href="mailto:{{ $action->specify_value }}"><img
                                src="/assets/skoodos/assets/img/footer/mail.png" alt=""
                                class="footer-contact-icon">
                            <span>{{ $action->specify_value }}</span></a></li>
                @endif
                @if ($action->call_to_action_type == 2)
                    <li> <a href="tel:+91 {{ $action->specify_value }}"> <img
                                src="/assets/skoodos/assets/img/footer/call.png" alt=""
                                class="footer-contact-icon">
                            <span>+91 {{ $action->phoneNumber() }}</span> </a></li>
                @endif
            @endif
        @endforeach

    </ul>
</div>
