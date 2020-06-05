@extends('layouts.general')

@section('content')
    <div class="float-right">
        <a href="{{ route('projects.edit', ['project' => $project['id']]) }}" class="btn btn-primary m-1">{{ __('projects/show.change') }}</a>
    </div>
    <h1>{{ $title }}</h1>

    <div class="card profile">
        <div class="card-body">
            <p class="mt-2 text-center">
                @todo список тикетов
            </p>
        </div>
    </div>
@endsection
