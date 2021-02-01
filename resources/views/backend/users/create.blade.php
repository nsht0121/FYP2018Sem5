@extends('backend.layout.default')

@section('title', trans('backend.users.create.title').' - '.trans('backend.name').' | '.trans('site.name'))

@section('header')
<h1 class="ui inverted header">
    <i class="settings icon"></i>
    <div class="content">
        @lang('backend.users.title')
        <div class="sub header">@lang('backend.users.subtitle.create')</div>
    </div>
</h1>
@endsection

@section('breadcrumb')
<div class="ui breadcrumb">
    <a href="{{ route('backend.dashboard') }}" class="section">@lang('backend.dashboard.title')</a>
    <i class="right chevron icon divider"></i>
    <a href="{{ route('backend.users.index') }}" class="section">@lang('backend.users.title')</a>
    <i class="right chevron icon divider"></i>
    <div class="active section">@lang('backend.users.subtitle.create')</div>
</div>
@endsection

@section('content')
<div class="ui top attached inverted center aligned header">
    <p>@lang('backend.users.subtitle.create')</p>
</div>
@if ($errors->any())
<div class="ui attached segment">
    <div class="ui error message">
        <ul class="ui list">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

{!! Form::open(['class' => 'ui form error', 'method' => 'POST', 'route' => ['backend.users.store']]) !!}

<h4 class="ui attached block header">
    <i class="pencil alternate icon"></i>
    <div class="content">@lang('backend.news.table.info')</div>
</h4>

<div class="ui attached segment">
    {{--  Email  --}}
    <div class="field {{ $errors->has('email') ? 'error' : '' }}">
        {!! Form::label('email', trans('backend.users.table.email')) !!}
        {!! Form::email('email', old('email'), ['required' => 'required']) !!}
    </div>

    {{--  Username  --}}
    <div class="field {{ $errors->has('username') ? 'error' : '' }}">
        {!! Form::label('username', trans('backend.users.table.username')) !!}
        {!! Form::text('username', old('username'), ['required' => 'required']) !!}
    </div>

    {{--  Password  --}}
    <div class="field {{ $errors->has('password') ? 'error' : '' }}">
        {!! Form::label('password', trans('backend.users.table.password')) !!}
        {!! Form::password('password', ['required' => 'required']) !!}
    </div>
</div>

<div class="ui bottom attached block header">
    {!! Form::submit(trans('backend.users.table.save'), ['class' => 'ui blue button']) !!}
</div>

{!! Form::close() !!}
@endsection