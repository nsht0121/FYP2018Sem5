@extends('backend.layout.default')

@section('title', trans('backend.eventCategory.subtitle.edit'))

@section('header')
<h1 class="ui inverted header">
    <i class="settings icon"></i>
    <div class="content">
        @lang('backend.eventCategory.title')
        <div class="sub header">@lang('backend.eventCategory.subtitle.index')</div>
    </div>
</h1>
@endsection

@section('breadcrumb')
<div class="ui breadcrumb">
    <a href="{{ route('backend.dashboard') }}" class="section">@lang('backend.dashboard.title')</a>
    <i class="right chevron icon divider"></i>
    <a href="{{ route('backend.event_categories.index') }}" class="section">@lang('backend.eventCategory.title')</a>
    <i class="right chevron icon divider"></i>
    <div class="active section">@lang('backend.eventCategory.subtitle.edit')</div>
</div>
@endsection

@section('content')
<div class="ui top attached inverted center aligned header">
    <p>@lang('backend.eventCategory.subtitle.edit')</p>
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

{!! Form::model($eventCategory, ['class' => 'ui form error', 'method' => 'PATCH', 'route' => ['backend.event_categories.update', $eventCategory->id]]) !!}

<h4 class="ui attached block header">
    <i class="pencil alternate icon"></i>
    <div class="content">@lang('backend.eventCategory.table.info')</div>
</h4>

<div class="ui attached segment">
    {{--  Name  --}}
    <div class="field {{ $errors->has('name') ? 'error' : '' }}">
        {!! Form::label('name', trans('backend.eventCategory.table.name')) !!}
        {!! Form::text('name', old('name'), ['required' => 'required']) !!}
    </div>
</div>

<div class="ui bottom attached block header">
    {!! Form::submit(trans('backend.eventCategory.table.save'), ['class' => 'ui blue button']) !!}
</div>

{!! Form::close() !!}
</div>
@endsection
