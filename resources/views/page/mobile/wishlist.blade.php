@extends('layouts.mobile.sub-master')

@section('content')
    @livewire('student-profile.profile.wishlist')
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
@endpush
