@extends('backend.layout.default')

@section('title', trans('backend.news.subtitle.edit'))

@section('header')
<h1 class="ui inverted header">
    <i class="settings icon"></i>
    <div class="content">
        @lang('backend.news.title')
        <div class="sub header">@lang('backend.news.subtitle.edit')</div>
    </div>
</h1>
@endsection

@section('breadcrumb')
<div class="ui breadcrumb">
    <a href="{{ route('backend.dashboard') }}" class="section">@lang('backend.dashboard.title')</a>
    <i class="right chevron icon divider"></i>
    <a href="{{ route('backend.news.index') }}" class="section">@lang('backend.news.title')</a>
    <i class="right chevron icon divider"></i>
    <div class="active section">@lang('backend.news.subtitle.edit')</div>
</div>
@endsection

@section('content')
<div class="ui top attached inverted center aligned header">
    <p>@lang('backend.news.subtitle.edit')</p>
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

{!! Form::model($news, ['class' => 'ui form error', 'method' => 'PATCH', 'route' => ['backend.news.update', $news->id], 'files' => true]) !!}

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
        <label>@lang('backend.news.table.currentImage')</label>
        @if ($news->thumbnail)
            <img src="{{ asset($news->thumbnail) }}">
        @else
            <p>沒有圖片</p>
        @endif
    </div>

    <div class="field">
        {!! Form::label('image', trans('backend.news.table.image')) !!}
        {!! Form::file('image') !!}
    </div>

    {{--  Category  --}}
    <div class="field">
        {!! Form::label('categories[]', trans('backend.news.table.category')) !!}
        {!! Form::select('categories[]', $categories, $selectedCategories, ['multiple' => 'multiple', 'class' => 'ui dropdown']) !!}
    </div>

    <div class="fields">
        {{--  Published  --}}
        <div class="inline field">
            <div class="ui checkbox">
                {!! Form::checkbox('is_hidden', 1, $news->is_hidden) !!}
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
