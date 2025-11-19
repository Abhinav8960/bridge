@extends('layouts.errors')

@section('title', __('Service Unavailable'))
@section('code', '503')
{{-- @section('message', __('Service Unavailable')) --}}
@section('image', '/assets/skoodos/assets/img/error/503.jpg')
@section('message', __('Service Unavailable, We Think You Turned the Wrong Way, Lets Go Back'))