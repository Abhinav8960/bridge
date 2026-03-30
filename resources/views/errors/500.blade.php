@extends('layouts.errors')


@section('title', __('Server Error'))
@section('code', '500')
{{-- @section('message', __('Server Error')) --}}
@section('image', '/assets/skoodos/assets/img/error/500.jpg')
@section('message', __('Server Error, We Think You Turned the Wrong Way, Lets Go Back'))