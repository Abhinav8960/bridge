<urlset xmlns="http://www.google.com/schemas/sitemap/0.84" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">


    @foreach ($exams as $d)
        <url>
            <loc>
                {{ env('APP_URL') }}/{{ $d->id }}/0/0/0/0/0/{{ strtolower(str_replace(' ', '-', $d->name)) }}-coaching-in-india
            </loc>
        </url>
    @endforeach
    {{-- entrance exam by  --}}
    @foreach ($exams as $d)
        @foreach ($institutesStateWises as $institutesStateWise)
            <url>
                <loc>
                    {{ env('APP_URL') }}/{{ $d->id }}/0/0/{{ $institutesStateWise->state_id }}/0/0/{{ strtolower(str_replace(' ', '-', $d->name)) }}-coaching-in-{{ strtolower(str_replace(' ', '-', $institutesStateWise->state_name)) }}
                </loc>
            </url>
        @endforeach
    @endforeach

    @foreach ($exams as $d)
        @foreach ($institutesStateCityWises as $institutesStateCityWise)
            <url>
                <loc>
                    {{ env('APP_URL') }}/{{ $d->id }}/0/0/{{ $institutesStateCityWise->state_id }}/{{ $institutesStateCityWise->city_id }}/0/{{ strtolower(str_replace(' ', '-', $institutesStateCityWise->state_name)) }}/{{ strtolower(str_replace(' ', '-', $d->name)) }}-coaching-in-{{ strtolower(str_replace(' ', '-', $institutesStateCityWise->city_name)) }}
                </loc>
            </url>
        @endforeach
    @endforeach

    {{-- stream entrance exam by --}}



</urlset>
