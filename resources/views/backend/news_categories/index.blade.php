@extends('backend.layout.default')

@section('title', trans('backend.newsCategory.title'))

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
    <div class="active section">@lang('backend.newsCategory.title')</div>
</div>
@endsection

@section('menu')
{{--  Control List  --}}
<div class="ui top attached inverted center aligned header">
    @lang('backend.control')
</div>
<div class="ui bottom attached center aligned segment">
    <a class="ui primary button" href="{{ route('backend.news_categories.create') }}">@lang('backend.newsCategory.subtitle.create')</a>
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
            <th class="ten wide">@lang('backend.newsCategory.list.name')</th>
            <th class="six wide">@lang('backend.newsCategory.list.dateCreated')</th>
            <th class="collapsing"></th>
    </tr></thead>

    {{--  Table Body  --}}
    <tbody>
    @isset($newsCategories)
        @forelse ($newsCategories as $n)
            <tr>
                <td>
                    <div class="ui checkbox">
                        <input type="checkbox">
                    </div>
                </td>
                <td>{{ $n->name }}</td>
                <td>{{ empty($n->created_at) ? 'N/A' : $n->created_at->format('Y/m/d - H:i:s') }}</td>
                <td>
                    <div class="ui small basic icon buttons">
                        <a class="ui disabled button" title="{{ trans('backend.view') }}" href="{{ route('backend.news_categories.show', $n->id) }}"><i class="eye icon"></i></a>
                        <a class="ui button" title="{{ trans('backend.edit') }}" href="{{ route('backend.news_categories.edit', $n->id) }}"><i class="edit icon"></i></a>
                        {!! Form::open(['id' => 'form-delete'.$n->id, 'method' => 'DELETE', 'route' => ['backend.news_categories.destroy', $n->id]]) !!}
                            <button class="ui button" title="{{ trans('backend.delete') }}" type="submit" onclick="event.preventDefault(); deleteItem({{$n->id}});">
                                <i class="trash red icon"></i>
                            </button>
                        {!! Form::close() !!}
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">沒有文章類別</td></tr>
        @endforelse
    @endisset
    </tbody>

    {{--  Table Foot  --}}
    <tfoot>
        <tr class="center aligned"><th colspan="4">
            {{ $newsCategories->links() }}
        </th></tr>
    </tfoot>
</table>
@endsection

@include('backend.inc.delete_alert')
