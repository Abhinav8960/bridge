<header class="sub-header">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between">
                <a href="/"><i class="bi bi-arrow-left"></i>Microsite: General</a>
                <div class="d-flex gap-4">
                    {{-- @if (Route::is('configuration.*')) --}}
                    {{-- @if ($coursesTab || $videosTab) --}}
                        <a href="microsite.html" data-bs-toggle="modal" data-bs-target="#microsite-filter"><i
                                class="bi bi-funnel-fill"></i></a>
                    {{-- @endif --}}
                    <a href="" data-bs-toggle="modal" data-bs-target="#microsite-option-model"><img
                            src="/assets/skoodos/assets/img/microsite/Menu.png" alt=""></a>
                </div>
            </div>

        </div>
    </div>
</header>
