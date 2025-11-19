@extends('layouts.errors')


@section('title', __('Forbidden'))
@section('code', '403')
{{-- @section('message', __($exception->getMessage() ?: 'Forbidden')) --}}
@section('image', '/assets/skoodos/assets/img/error/403.jpg')
@section('message', __($exception->getMessage() ?: 'Forbidden, We Think You Turned the Wrong Way, Lets Go Back'))