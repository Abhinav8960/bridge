@extends('layouts.mobile.sub-master')
@section('content')

@livewire('blog-mobile.category', ['categoryname' => $category])

@livewireScripts
@endsection

