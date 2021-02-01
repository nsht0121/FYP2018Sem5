@extends('backend.layout.default')

@section('title', trans('backend.news.subtitle.create'))

@section('header')
<h1 class="ui inverted header">
    <i class="settings icon"></i>
    <div class="content">
        @lang('backend.news.title')
        <div class="sub header">@lang('backend.news.subtitle.create')</div>
    </div>
</h1>
@endsection

@section('breadcrumb')
<div class="ui breadcrumb">
    <a href="{{ route('backend.dashboard') }}" class="section">@lang('backend.dashboard.title')</a>
    <i class="right chevron icon divider"></i>
    <a href="{{ route('backend.news.index') }}" class="section">@lang('backend.news.title')</a>
    <i class="right chevron icon divider"></i>
    <div class="active section">@lang('backend.news.subtitle.create')</div>
</div>
@endsection

@section('content')
<div class="ui top attached inverted center aligned header">
    <p>@lang('backend.news.subtitle.create')</p>
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

{!! Form::open(['class' => 'ui form error', 'method' => 'POST', 'route' => ['backend.news.store'], 'files' => true]) !!}

<h4 class="ui attached block header">
    <i class="pencil alternate icon"></i>
    <div class="content">@lang('backend.news.table.info')</div>
</h4>

<div class="ui attached segment">
    {{--  Title  --}}
    <div class="field {{ $errors->has('title') ? 'error' : '' }}">
        {!! Form::label('title', trans('backend.news.table.title')) !!}
        {!! Form::text('title', old('title'), ['required' => 'required', 'maxlength' => 191]) !!}
    </div>

    {{--  Content  --}}
    <div class="field">
        {!! Form::label('content', trans('backend.news.table.content')) !!}
        {!! Form::textarea('content', old('content')) !!}
    </div>
</div>

<h4 class="ui attached block header">
    <i class="list icon"></i>
    <div class="content">@lang('backend.news.table.attribute')</div>
</h4>

<div class="ui attached segment">
    {{--  Image  --}}
    <div class="field">
        {!! Form::label('image', trans('backend.news.table.image')) !!}
        {!! Form::file('image') !!}
    </div>

    {{--  Category  --}}
    <div class="field">
        {!! Form::label('categories[]', trans('backend.news.table.category')) !!}
        {!! Form::select('categories[]', $categories, null, ['multiple' => 'multiple', 'class' => 'ui dropdown multi-selection']) !!}
    </div>

    <div class="fields">
        {{--  Published  --}}
        <div class="inline field">
            <div class="ui checkbox">
                {!! Form::checkbox('is_hidden', 1) !!}
                {!! Form::label('is_hidden', trans('backend.news.table.hidden')) !!}
            </div>
        </div>
    </div>
</div>

<div class="ui bottom attached block header">
    {!! Form::submit(trans('backend.news.table.save'), ['class' => 'ui blue button']) !!}
</div>

{!! Form::close() !!}
@endsection

@section('script')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>CKEDITOR.replace('content');</script>
@endsection
