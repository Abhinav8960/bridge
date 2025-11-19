<urlset xmlns="http://www.google.com/schemas/sitemap/0.84" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">


    @foreach ($exams as $d)
        @foreach ($exam_stream as $es)
            @if ($d->id == $es->category_id)
                <url>
                    <loc>
                        {{ env('APP_URL') }}/{{$d->id}}/{{ $es->id }}/0/0/0/0/{{ strtolower(str_replace(' ', '-', $es->name)) }}-coaching-in-india
                    </loc>
                </url>
            @endif
        @endforeach
    @endforeach

    @foreach ($exams as $d)
        @foreach ($exam_stream as $es)
            @if ($d->id == $es->category_id)
                @foreach ($institutesStateWises as $institutesStateWise)
                    <url>
                        <loc>
                            {{ env('APP_URL') }}/{{ $d->id }}/{{ $es->id }}/0/{{$institutesStateWise->state_id}}/0/0/{{ strtolower(str_replace(' ', '-', $es->name)) }}-coaching-in-{{ strtolower(str_replace(' ', '-', $institutesStateWise->state_name)) }}
                        </loc>
                    </url>
                @endforeach
            @endif
        @endforeach
    @endforeach


    @foreach ($exams as $d)
        @foreach ($exam_stream as $es)
            @if ($d->id == $es->category_id)
                @foreach ($institutesStateCityWises as $institutesStateCityWise)
                    <url>
                        <loc>
                            {{ env('APP_URL') }}/{{ $d->id }}/{{ $es->id }}/0/{{$institutesStateCityWise->state_id}}/{{$institutesStateCityWise->city_id}}/0/{{ strtolower(str_replace(' ', '-', $institutesStateCityWise->state_name)) }}/{{ strtolower(str_replace(' ', '-', $es->name)) }}-coaching-in-{{ strtolower(str_replace(' ', '-', $institutesStateCityWise->city_name)) }}
                        </loc>
                    </url>
                @endforeach
            @endif
        @endforeach
    @endforeach


</urlset>
