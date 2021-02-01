@extends('backend.layout.default')

@section('title', trans('backend.newsCategory.subtitle.create'))

@section('header')
<h1 class="ui inverted header">
    <i class="settings icon"></i>
    <div class="content">
        @lang('backend.newsCategory.title')
        <div class="sub header">@lang('backend.newsCategory.subtitle.index')</div>
    </div>
</h1>
@endsection

@section('breadcrumb')
<div class="ui breadcrumb">
    <a href="{{ route('backend.dashboard') }}" class="section">@lang('backend.dashboard.title')</a>
    <i class="right chevron icon divider"></i>
    <a href="{{ route('backend.news_categories.index') }}" class="section">@lang('backend.newsCategory.title')</a>
    <i class="right chevron icon divider"></i>
    <div class="active section">@lang('backend.newsCategory.subtitle.create')</div>
</div>
@endsection

@section('content')
<div class="ui top attached inverted center aligned header">
    <p>@lang('backend.newsCategory.subtitle.create')</p>
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

{!! Form::open(['class' => 'ui form error', 'method' => 'POST', 'route' => ['backend.news_categories.store']]) !!}

<h4 class="ui attached block header">
    <i class="pencil alternate icon"></i>
    <div class="content">@lang('backend.newsCategory.table.info')</div>
</h4>

<div class="ui attached segment">
    {{--  Name  --}}
    <div class="field {{ $errors->has('name') ? 'error' : '' }}">
        {!! Form::label('name', trans('backend.newsCategory.table.name')) !!}
        {!! Form::text('name', old('name'), ['required' => 'required']) !!}
    </div>
</div>

<div class="ui bottom attached block header">
    {!! Form::submit(trans('backend.newsCategory.table.save'), ['class' => 'ui blue button']) !!}
</div>

{!! Form::close() !!}
</div>
@endsection
