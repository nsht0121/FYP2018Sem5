@extends('backend.layout.default')

@section('title', trans('backend.events.title'))

@section('header')
<h1 class="ui inverted header">
    <i class="settings icon"></i>
    <div class="content">
        @lang('backend.events.title')
        <div class="sub header">@lang('backend.events.subtitle.index')</div>
    </div>
</h1>
@endsection

@section('breadcrumb')
<div class="ui breadcrumb">
    <a href="{{ route('backend.dashboard') }}" class="section">@lang('backend.dashboard.title')</a>
    <i class="right chevron icon divider"></i>
    <div class="active section">@lang('backend.events.title')</div>
</div>
@endsection

@section('menu')
{{--  Control List  --}}
<div class="ui top attached inverted center aligned header">
    @lang('backend.control')
</div>
<div class="ui bottom attached center aligned segment">
    <a class="ui primary button" href="{{ route('backend.events.create') }}">@lang('backend.events.subtitle.create')</a>
</div>
@endsection

@section('content')
<div class="ui top attached inverted header">
    <p>@lang('backend.overview')</p>
</div>

<table class="ui celled striped bottom attached table">
    {{--  Table Head  --}}
    <thead><tr>
        <th class="collapsing">
            <div class="ui fitted checkbox">
                <input type="checkbox" id="select-all">
                <label></label>
            </div>
        </th>
        <th>@lang('backend.events.list.title')</th>
        <th>@lang('backend.events.list.applyDate')</th>
        <th>@lang('backend.events.list.eventDate')</th>
        <th class="collapsing">@lang('backend.events.list.dateCreated')</th>
        <th class="collapsing">@lang('backend.events.list.hidden')</th>
        <th class="collapsing">@lang('backend.events.list.canceled')</th>
        <th class="collapsing"></th>
    </tr></thead>

    {{--  Table Body  --}}
    <tbody>
    @isset($events)
        @forelse ($events as $e)
            <tr>
                <td>
                    <div class="ui checkbox">
                        <input type="checkbox">
                    </div>
                </td>
                <td>{{ $e->title }}</td>
                <td>{{ $e->apply_date }}</td>
                <td>{{ $e->event_date }}</td>

                {{--  Created At  --}}
                <td>
                    {!! empty($e->created_at) ? 'N/A' : $e->created_at->format('y/m/d <\b\r> H:i:s') !!}
                </td>

                {{--  Published  --}}
                <td class="center aligned {{ ($e->is_hidden) ? 'warning' : '' }}">
                    @if ($e->is_hidden)
                    <i class="large yellow checkmark icon"></i>
                    @endif
                </td>

                {{--  Canceled  --}}
                <td class="center aligned {{ ($e->is_canceled) ? 'negative' : '' }}">
                    @if ($e->is_canceled)
                    <i class="large red checkmark icon"></i>
                    @endif
                </td>

                {{--  Buttons  --}}
                <td>
                    <div class="ui small basic icon buttons">
                        <a class="ui button" title="{{ trans('backend.view') }}" href="{{ route('backend.events.show', $e->id) }}"><i class="eye icon"></i></a>
                        <a class="ui button" title="{{ trans('backend.edit') }}" href="{{ route('backend.events.edit', $e->id) }}"><i class="edit icon"></i></a>
                        {!! Form::open(['id' => 'form-delete'.$e->id, 'method' => 'DELETE', 'route' => ['backend.events.destroy', $e->id]]) !!}
                            <button class="ui button" title="{{ trans('backend.delete') }}" type="submit" onclick="event.preventDefault(); deleteItem({{$e->id}});">
                                <i class="trash red icon"></i>
                            </button>
                        {!! Form::close() !!}
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="8">沒有活動</td></tr>
        @endforelse
    @endisset
    </tbody>

    {{--  Table Foot  --}}
    <tfoot><tr class="center aligned">
        <th colspan="8">
            {{ $events->links() }}
        </th>
    </tr></tfoot>
</table>
@endsection

@include('backend.inc.delete_alert')
