<script>
    $(document).ready(function() {
        $('.select-state').on('change', function() {
            var state_id = $(this).val();
            console.log(state_id);
            var url = "{{ route('search.fetchCity', ':state') }}";
            url = url.replace(':state', state_id);
            if (state_id) {
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('select[name="city_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city_id"]').append('<option value="' +
                                value.id + '">' + value.city + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="city_id"]').empty();
            }
        });


        $('.select-city').on('change', function() {
            var city_id = $(this).val();
            var state_id = $('#state_id').val();
            var url = "{{ route('search.fetchAllArea', [':state', ':city']) }}";
            url = url.replace(':state', state_id);
            url = url.replace(':city', city_id);
            if (city_id) {
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('select[name="area"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="area"]').append('<option value="' +
                                value.area + '">' + value.area + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="area"]').empty();
            }

        });

    });
</script>
