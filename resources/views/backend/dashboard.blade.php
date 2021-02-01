@extends('backend.layout.default')

@section('title', trans('backend.dashboard.title'))

@section('header')
<h1 class="ui inverted header">
    <i class="settings icon"></i>
    <div class="content">
        @lang('backend.dashboard.title')
        <div class="sub header">@lang('backend.dashboard.subtitle')</div>
    </div>
</h1>
@endsection

@section('breadcrumb')
<div class="ui breadcrumb">
    <div class="active section">@lang('backend.dashboard.title')</div>
</div>
@endsection

@section('content')
<div class="ui top attached inverted header">
    @lang('backend.overview')
</div>
<div class="ui bottom attached segment">
    <div class="ui three column doubling grid">
        {{--  Total User  --}}
        <div class="column">
            <div class="ui center aligned segment">
                <div class="ui small statistic">
                    <div class="value">
                        <i class="user icon"></i> {{ $counter['users'] }}
                    </div>
                    <div class="label">
                        @lang('backend.dashboard.board.user')
                    </div>
                </div>
            </div>
        </div>

        {{--  Total Events  --}}
        <div class="column">
            <div class="ui center aligned segment">
                <div class="ui small statistic">
                    <div class="value">
                        <i class="calendar icon"></i> {{ $counter['events'] }}
                    </div>
                    <div class="label">
                        @lang('backend.dashboard.board.event')
                    </div>
                </div>
            </div>
        </div>

        {{--  Total Posts  --}}
        <div class="column">
            <div class="ui center aligned segment">
                <div class="ui small statistic">
                    <div class="value">
                        <i class="file icon"></i> {{ $counter['posts'] }}
                    </div>
                    <div class="label">
                        @lang('backend.dashboard.board.post')
                    </div>
                </div>
            </div>
        </div>

        {{--  Total Visitors  --}}
        <div class="column">
            <div class="ui center aligned segment">
                <div class="ui small statistic">
                    <div class="value">
                        <i class="chart bar icon"></i> /
                    </div>
                    <div class="label">
                        @lang('backend.dashboard.board.visitor')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ui top attached inverted header">
    @lang('backend.dashboard.latsetUser')
</div>
<div class="ui bottom attached segment">
    <table class="ui celled padded table">
        <thead><tr>
            <th>@lang('backend.dashboard.secondBoard.username')</th>
            <th>@lang('backend.dashboard.secondBoard.email')</th>
            <th>@lang('backend.dashboard.secondBoard.dateJoined')</th>
        </tr></thead>
        <tbody>
            @forelse ($users as $u)
                <tr>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ empty($u->created_at) ? 'N/A' : $u->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr><td colspan="3">No User</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection