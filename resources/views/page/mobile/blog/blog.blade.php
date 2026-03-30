@extends('layouts.mobile.sub-master')
@section('content')
    @livewire('blog-mobile.blog', ['month' => $month, 'year' => $year]);
@livewireScripts

@endsection
