@extends('backend.layout.default')

@section('title', trans('backend.eventClass.subtitle.edit'))

@section('header')
<h1 class="ui inverted header">
    <i class="settings icon"></i>
    <div class="content">
        @lang('backend.eventClass.title')
        <div class="sub header">@lang('backend.eventClass.subtitle.edit')</div>
    </div>
</h1>
@endsection

@section('breadcrumb')
<div class="ui breadcrumb">
    <a href="{{ route('backend.dashboard') }}" class="section">@lang('backend.dashboard.title')</a>
    <i class="right chevron icon divider"></i>
    <a href="{{ route('backend.events.index') }}" class="section">@lang('backend.events.title')</a>
    <i class="right chevron icon divider"></i>
    <a href="{{ route('backend.events.show', $class->event_id) }}" class="section">@lang('backend.events.subtitle.show')</a>
    <i class="right chevron icon divider"></i>
    <div class="active section">@lang('backend.eventClass.subtitle.edit')</div>
</div>
@endsection

@section('content')
<div class="ui top attached inverted center aligned header">
    <p>@lang('backend.eventClass.subtitle.edit')</p>
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

{!! Form::model($class, ['class' => 'ui form error', 'method' => 'PATCH', 'route' => ['backend.event_classes.update', $class->id]]) !!}

<h4 class="ui attached block header">
    <i class="pencil alternate icon"></i>
    <div class="content">@lang('backend.eventClass.table.info')</div>
</h4>

<div class="ui attached segment">
    {{--  Name  --}}
    <div class="field {{ $errors->has('name') ? 'error' : '' }}">
        {!! Form::label('name', trans('backend.eventClass.table.name')) !!}
        {!! Form::text('name', old('name'), ['required' => 'required']) !!}
    </div>

    {{--  Quota  --}}
    <div class="field {{ $errors->has('quota') ? 'error' : '' }}">
        {!! Form::label('quota', trans('backend.events.table.quota')) !!}
        {!! Form::number('quota', old('quota'), ['min' => 0, 'max' => 9999]) !!}
    </div>

    {{--  Hidden Id  --}}
    {!! Form::hidden('event_id', $class->event_id) !!}
</div>

<div class="ui bottom attached block header">
    {!! Form::submit(trans('backend.eventClass.table.save'), ['class' => 'ui blue button']) !!}
</div>

{!! Form::close() !!}
</div>
@endsection
