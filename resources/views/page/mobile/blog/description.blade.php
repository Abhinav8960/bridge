@extends('layouts.mobile.sub-master')
@section('title')
    {{ $post->meta_title }}
    {{-- @dd($post->meta_title) --}}
@endsection

@section('metadescription')
    {{ $post->meta_description }}
@endsection

@section('content')
    @livewire('blog-mobile.description', ['slug' => $slug])
    @livewireScripts
@endsection
