@extends('backend.layout.default')

@section('title', trans('backend.events.subtitle.show'))

@section('header')
<h1 class="ui inverted header">
    <i class="settings icon"></i>
    <div class="content">
        @lang('backend.events.title')：{{ $event->title }}
        <div class="sub header">@lang('backend.events.subtitle.show')</div>
    </div>
</h1>
@endsection

@section('breadcrumb')
<div class="ui breadcrumb">
    <a href="{{ route('backend.dashboard') }}" class="section">@lang('backend.dashboard.title')</a>
    <i class="right chevron icon divider"></i>
    <a href="{{ route('backend.events.index') }}" class="section">@lang('backend.events.title')</a>
    <i class="right chevron icon divider"></i>
    <div class="active section">@lang('backend.events.subtitle.show')</div>
</div>
@endsection

@section('menu')
{{--  Control List  --}}
<div class="ui top attached inverted center aligned header">
    @lang('backend.control')
</div>
<div class="ui bottom attached center aligned segment">
    <a class="ui blue button" href="{{ route('backend.events.create') }}">@lang('backend.events.subtitle.create')</a>
    <a class="ui green button" href="{{ route('backend.event_classes.create', ['eventId' => $event->id]) }}">@lang('backend.eventClass.subtitle.create')</a>
</div>
@endsection

@section('content')
<div class="ui top attached inverted header">
    <p>@lang('backend.overview')</p>
</div>

<table class="ui celled bottom attached table">
    {{--  Table Body  --}}
    <tbody>
        <tr><td class="two wide">@lang('backend.events.list.title')</td><td class="fourteen wide">{{ $event->title }}</td></tr>
        <tr><td>@lang('backend.events.list.description')</td><td>{{ $event->description }}</td></tr>
        <tr><td>@lang('backend.events.list.venue')</td><td>{{ $event->venue }}</td></tr>
        <tr><td>@lang('backend.events.list.fee')</td><td>${{ $event->fee }}</td></tr>
        <tr><td>@lang('backend.events.list.applyDate')</td><td>{{ $event->apply_start | $event->apply_end }}</td></tr>
        <tr><td>@lang('backend.events.list.eventDate')</td><td>{{ $event->event_start | $event->event_end }}</td></tr>
        <tr><td>@lang('backend.events.list.published')</td><td>{{ $event->is_published }}</td></tr>
        <tr><td>@lang('backend.events.list.canceled')</td><td>{{ $event->is_canceled }}</td></tr>
    </tbody>
</table>

<div class="ui top attached inverted header">
    <p>@lang('backend.events.class')</p>
</div>

<table class="ui celled striped compact bottom attached table">
    {{--  Table Head  --}}
    <thead><tr>
        <th class="collapsing">
            <div class="ui fitted checkbox">
                <input type="checkbox" id="select-all">
                <label></label>
            </div>
        </th>
        <th>@lang('backend.eventClass.list.name')</th>
        <th>@lang('backend.eventClass.list.participant')</th>
        <th class="collapsing"></th>
    </tr></thead>

    {{--  Table Body  --}}
    <tbody>
    @forelse ($event->eventClasses as $ec)
        <tr>
            <td>
                <div class="ui checkbox">
                    <input type="checkbox">
                </div>
            </td>
            <td>{{ $ec->name }}</td>
            <td>{{ ($ec->quota > 0) ? $ec->users()->count()."/".$ec->quota : $ec->users()->count() }}</td>

            {{--  Buttons  --}}
            <td>
                <div class="ui small basic icon buttons">
                    <a class="ui button" title="{{ trans('backend.view') }}" href="{{ route('backend.event_classes.show', $ec->id) }}"><i class="eye icon"></i></a>
                    <a class="ui button" title="{{ trans('backend.edit') }}" href="{{ route('backend.event_classes.edit', $ec->id) }}"><i class="edit icon"></i></a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['backend.event_classes.destroy', $ec->id]]) !!}
                    <button class="ui button" title="{{ trans('backend.delete') }}" type="submit"><i class="trash icon"></i></button>
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @empty
        <tr><td colspan="3">No Class</td></tr>
    @endforelse
    </tbody>
</table>

@endsection
