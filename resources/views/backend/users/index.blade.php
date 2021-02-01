@extends('backend.layout.default')

@section('title', trans('backend.users.index.title').' - '.trans('backend.name').' | '.trans('site.name'))

@section('header')
<h1 class="ui inverted header">
    <i class="settings icon"></i>
    <div class="content">
        @lang('backend.users.title')
        <div class="sub header">@lang('backend.users.subtitle.index')</div>
    </div>
</h1>
@endsection

@section('breadcrumb')
<div class="ui breadcrumb">
    <a href="{{ route('backend.dashboard') }}" class="section">@lang('backend.dashboard.title')</a>
    <i class="right chevron icon divider"></i>
    <div class="active section">@lang('backend.users.title')</div>
</div>
@endsection

@section('menu')
{{--  Control List  --}}
<div class="ui top attached inverted header">
    @lang('backend.control')
</div>
<div class="ui bottom attached center aligned segment">
    <a class="ui primary button" href="{{ route('backend.users.create') }}">@lang('backend.users.subtitle.create')</a>
</div>
@endsection

@section('content')
<div class="ui top attached inverted header">
    <p>@lang('backend.overview')</p>
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
            <th>@lang('backend.users.list.username')</th>
            <th>@lang('backend.users.list.email')</th>
            <th>@lang('backend.users.list.dateCreated')</th>
            <th class="collapsing"></th>
    </tr></thead>

    {{--  Table Body  --}}
    <tbody>
    @isset($users)
        @forelse ($users as $u)
        <tr>
            <td>
                <div class="ui checkbox">
                    <input type="checkbox">
                </div>
            </td>
            <td>{{ $u->username }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ empty($u->created_at) ? 'N/A' : $u->created_at->format('Y-m-d : H-i-s') }}</td>
            <td>
                <div class="ui small basic icon buttons">
                    <a class="ui button" title="{{ trans('backend.view') }}" href="{{ route('backend.users.show', $u->id) }}"><i class="eye icon"></i></a>
                    <a class="ui button" title="{{ trans('backend.edit') }}" href="{{ route('backend.users.edit', $u->id) }}"><i class="edit icon"></i></a>
                    @if ($u->id != 1)
                    {!! Form::open(['method' => 'DELETE', 'route' => ['backend.users.destroy', $u->id]]) !!}
                    <button class="ui button" title="{{ trans('backend.delete') }}" type="submit"><i class="trash icon"></i></button>
                    {!! Form::close() !!} 
                    @endif
                </div>
            </td>
        </tr>
        @empty
            
        @endforelse
    @endisset
    </tbody>

    {{--  Table Foot  --}}
    <tfoot>
        <tr class="center aligned"><th colspan="5">
            {{ $users->links() }}
        </th></tr>
    </tfoot>
</table>
@endsection