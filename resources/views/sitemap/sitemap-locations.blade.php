<urlset xmlns="http://www.google.com/schemas/sitemap/0.84" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">
    <url>
        <loc>{{ env('APP_URL') }}/coaching-institutes-in-india</loc>
    </url>

    @foreach ($institutesStateWises as $institutesStateWise)
        <url>
            <loc>
                {{ env('APP_URL') }}/0/0/0/{{ $institutesStateWise->state_id }}/0/0/coaching-in-{{ $institutesStateWise->state_name }}
            </loc>
        </url>
    @endforeach

    @foreach ($institutesStateCityWises as $institutesStateCityWise)
        <url>
            <loc>
                {{ env('APP_URL') }}/0/0/0/{{ $institutesStateCityWise->state_id }}/{{ $institutesStateCityWise->city_id }}/0/{{ $institutesStateCityWise->state_name }}/coaching-in-{{ $institutesStateCityWise->city_name }}
            </loc>
        </url>
    @endforeach

    @foreach ($institutesStateCityAreaWises as $institutesStateCityAreaWise)
        <url>
            <loc>
                {{ env('APP_URL') }}/0/0/0/{{ $institutesStateCityAreaWise->state_id }}/{{ $institutesStateCityAreaWise->city_id }}/{{ $institutesStateCityAreaWise->area_id }}/{{ $institutesStateCityAreaWise->city_name }}/coaching-in-{{ $institutesStateCityAreaWise->area }}
            </loc>
        </url>
    @endforeach


</urlset>
