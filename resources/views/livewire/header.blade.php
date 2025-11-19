<div>
    <div class="top_contact d-flex align-items-center">
        @foreach ($callToAction as $action)
            @if ($action->is_showin_header == 1)
                @if ($action->call_to_action_type == 1)
                    <a href="mailto:{{ $action->specify_value }}"><img src="/assets/skoodos/assets/img/homepage/mail.png"
                            alt="">{{ $action->specify_value }}</a>
                @endif
                @if ($action->call_to_action_type == 2)
                    <a href="tel:+91 {{ $action->specify_value }}"><img src="/assets/skoodos/assets/img/homepage/call.png" alt="">+91
                        {{ $action->phoneNumber() }} </a>
                @endif
            @endif
        @endforeach
    </div>
</div>
