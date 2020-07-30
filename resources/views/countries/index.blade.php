@extends('layouts.layout')

@section('title', __('messages.countries'))

@section('content')

<div class="container">

    @php
        $breadcrumbs = [
            [
                'url' => '/',
                'title' => __('messages.home'),
            ],
            [
                'url' => App\Helpers\RouteBuilder::localeRoute('cms.countries.index'),
                'title' => __('messages.countries'),
            ],
        ];
    @endphp

    @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
    @include('countries.blocks.header.list')
    @include('cms.blocks.form.messages')
    @include('countries.blocks.list.index')
</div>
@endsection
