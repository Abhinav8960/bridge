<div>
    <div class="contact-links mt-3">
        @foreach ($callToAction as $action)
            @if ($action->is_showin_contact_page == 1)
                @if ($action->call_to_action_type == 1)
                    <a href=""><i class="bi bi-envelope-fill"></i>{{ $action->specify_value }}</a>
                @endif
                @if ($action->call_to_action_type == 2)
                    <a href=""><i class="bi bi-telephone-fill"></i>+91-{{ $action->phoneNumber() }}</a>
                @endif
            @endif
        @endforeach
    </div>
</div>
