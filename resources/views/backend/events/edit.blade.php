@extends('backend.layout.default')

@section('title', trans('backend.events.subtitle.edit'))

@section('header')
<h1 class="ui inverted header">
    <i class="settings icon"></i>
    <div class="content">
        @lang('backend.events.title')
        <div class="sub header">@lang('backend.events.subtitle.edit')</div>
    </div>
</h1>
@endsection

@section('breadcrumb')
<div class="ui breadcrumb">
    <a href="{{ route('backend.dashboard') }}" class="section">@lang('backend.dashboard.title')</a>
    <i class="right chevron icon divider"></i>
    <a href="{{ route('backend.events.index') }}" class="section">@lang('backend.events.title')</a>
    <i class="right chevron icon divider"></i>
    <div class="active section">@lang('backend.events.subtitle.edit')</div>
</div>
@endsection

@section('content')
<div class="ui top attached inverted center aligned header">
    <p>@lang('backend.events.subtitle.edit')</p>
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

{!! Form::model($event, ['class' => 'ui form error', 'method' => 'PATCH', 'route' => ['backend.events.update', $event->id], 'files' => true]) !!}

<h4 class="ui attached block header">
    <i class="pencil alternate icon"></i>
    <div class="content">@lang('backend.events.table.info')</div>
</h4>

<div class="ui attached segment">
    {{--  Title  --}}
    <div class="field {{ $errors->has('title') ? 'error' : '' }}">
        {!! Form::label('title', trans('backend.events.table.title')) !!}
        {!! Form::text('title', old('title'), ['required' => 'required', 'maxlength' => 191]) !!}
    </div>

    {{--  Description  --}}
    <div class="field">
        {!! Form::label('description', trans('backend.events.table.description')) !!}
        {!! Form::textarea('description', old('description')) !!}
    </div>

    {{--  Venue  --}}
    <div class="field">
        {!! Form::label('venue', trans('backend.events.table.venue')) !!}
        {!! Form::text('venue', old('venue')) !!}
    </div>

    {{--  Fee  --}}
    <div class="field">
        {!! Form::label('fee', trans('backend.events.table.fee')) !!}
        <div class="ui labeled input">
            {!! Form::label('fee', '$', ['class' => 'ui label']) !!}
            {!! Form::number('fee', 0.0, ['step' => '0.1', 'min' => 0.0, 'max' => 9999.9]) !!}
        </div>
    </div>
</div>

<h4 class="ui attached block header">
    <i class="calendar icon"></i>
    <div class="content">@lang('backend.events.table.dateAndTime')</div>
</h4>

<div class="ui attached segment">
    <div class="four fields">
        {{--  Event Start  --}}
        <div class="field">
            {!! Form::label('event_start', trans('backend.events.table.eventStart')) !!}
            {!! Form::text('event_start', old('event_start')) !!}
        </div>

        {{--  Event End  --}}
        <div class="field">
            {!! Form::label('event_end', trans('backend.events.table.eventEnd')) !!}
            {!! Form::text('event_end', old('event_end')) !!}
        </div>

        {{--  Apply Start  --}}
        <div class="field">
            {!! Form::label('apply_start', trans('backend.events.table.applyStart')) !!}
            {!! Form::text('apply_start', old('apply_start')) !!}
        </div>

        {{--  Apply End  --}}
        <div class="field">
            {!! Form::label('apply_end', trans('backend.events.table.applyStart')) !!}
            {!! Form::text('apply_end', old('apply_end')) !!}
        </div>
    </div>
</div>

<h4 class="ui attached block header">
    <i class="list icon"></i>
    <div class="content">@lang('backend.events.table.attribute')</div>
</h4>

<div class="ui attached segment">
    {{--  Image  --}}
    <div class="field">
        <label>@lang('backend.news.table.currentImage')</label>
        @if ($event->thumbnail)
            <img src="{{ asset($event->thumbnail) }}">
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
        {!! Form::label('categories[]', trans('backend.events.table.category')) !!}
        {!! Form::select('categories[]', $categories, $selectedCategories, ['multiple' => 'multiple', 'class' => 'ui dropdown multi-selection']) !!}
    </div>

    <div class="fields">
        {{--  Published  --}}
        <div class="inline field">
            <div class="ui checkbox">
                {!! Form::checkbox('is_hidden', 1, $event->is_published) !!}
                {!! Form::label('is_hidden', trans('backend.events.table.isHidden')) !!}
            </div>
        </div>

        {{--  Canceled  --}}
        <div class="inline field">
            <div class="ui checkbox">
                {!! Form::checkbox('is_canceled', 1, $event->is_canceled) !!}
                {!! Form::label('is_canceled', trans('backend.events.table.isCanceled')) !!}
            </div>
        </div>
    </div>
</div>

<div class="ui bottom attached block header">
    {!! Form::submit(trans('backend.events.table.save'), ['class' => 'ui blue button']) !!}
</div>

{!! Form::close() !!}
@endsection

@section('script')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>CKEDITOR.replace( 'description' );</script>
@endsection
