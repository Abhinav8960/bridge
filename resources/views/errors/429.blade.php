@extends('layouts.errors')


@section('title', __('Too Many Requests'))
@section('code', '429')
{{-- @section('message', __('Too Many Requests')) --}}
@section('image', '/assets/skoodos/assets/img/error/429.jpg')
@section('message', __('Too Many Requests, We Think You Turned the Wrong Way, Lets Go Back'))