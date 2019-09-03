@extends('register.layout')

@section('favicon')
    {{ Html::favicon( '/images/favicon.png' ) }}
@endsection

@section('title', __('messages.registration'))

@section('style')
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md main-title">
                {{__('messages.registration')}}
            </div>

            <div class="links">
                <a href="/">{{__('messages.main')}}</a>
                <a href="/register">{{__('messages.registration')}}</a>
                <a href="/user">{{__('messages.userPage')}}</a>
                <a href="/helps">{{__('messages.referenceInformation')}}</a>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="title m-b-md form-align">
            <form>

                    <div class="form-group col-md-6 max-width">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6 max-width">
                        <label for="inputPassword1">Password</label>
                        <input type="password" class="form-control" id="inputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group col-md-6 max-width">
                        <label for="inputPassword2">Confirmation Password</label>
                        <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                    </div>




                <button type="submit" class="btn btn-primary button-reg">Sign in</button>
            </form>
        </div>

    </div>
@endsection