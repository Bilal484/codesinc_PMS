@extends('layouts.guest')

@section('title', __('auth.login'))

@section('content')

<div class="login-panel col-md-4 col-md-offset-4 text-center">
    <img style="width: 100px" src="{{ asset('assets/imgs/codesinc_logo.png') }}" alt="User Icon">
    <h3>{{ config('app.name') }}</h3>
    <div class="panel panel-default">
        <div class="panel-body">
        	{{ Form::open(['route' => 'auth.login']) }}
            {!! FormField::email('email', ['label' => false, 'placeholder'=> __('auth.email')]) !!}
            {!! FormField::password('password', ['label' => false, 'placeholder'=> __('auth.password')]) !!}
            {{ Form::submit(__('auth.login'), ['class' => 'btn btn-success btn-block']) }}
            {{ link_to_route('auth.reset-request', __('auth.forgot_password'), [], ['class' => 'btn btn-link']) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
