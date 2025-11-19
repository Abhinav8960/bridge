@if (!empty($bradcrumbs))
    <div id="breadcrumbs">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach ($bradcrumbs as $bradcrumb)
                        <li class="breadcrumb-item @if ($loop->last) active @endif"><a
                                href="@if (isset($bradcrumb['url'])) {{ $bradcrumb['url'] }} @endif">{{ $bradcrumb['page'] }}</a>
                        </li>
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
@endif
