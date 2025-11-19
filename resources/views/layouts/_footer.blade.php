<a href="#" class="back-to-top d-flex align-items-center justify-content-center active"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('assets/skoodos/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/skoodos/assets/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/skoodos/assets/vendor/slick/slick-lightbox.js') }}"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/skoodos/assets/js/main.js') }}"></script>

<script src="{{ asset('assets/skoodos/assets/vendor/slick/slick-lightbox.js') }}"></script>
{{-- <script src='https://www.google.com/recaptcha/api.js'></script> --}}
<!-- -------==== Cities Slider ======= -->

@livewireScripts()

@livewire('get-location')

@stack('scripts')


</body>

</html>
