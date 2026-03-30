<div>
    @if ($isNeedToRender)
        @push('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                getLocation();
            });

            function getLocation() {
                navigator.geolocation.getCurrentPosition(onSuccess);
            }

            function onSuccess(position) {
                const {
                    latitude,
                    longitude
                } = position.coords;

                @this.lat = latitude;
                @this.lng = longitude;

            
            }
        </script>
        @endpush
    @endif
   
</div>

