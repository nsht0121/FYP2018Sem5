<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    {{-- Meta --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - @lang('backend.name') | @lang('site.name')</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}"/>

    {{-- Styles --}}
    <link href="{{ asset('css/semantic.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">
</head>

<body>
{{--  Top Menu  --}}
<div id="top-menu" class="ui attached borderless inverted menu">
    <div class="ui container">
        <div class="item">@lang('backend.name')</div>
        <div class="right menu">
            <div class="item">@lang('backend.welcome'){{ Auth::user()->username }}</div>
            <a href="/" class="item"><i class="home icon"></i>@lang('backend.backhome')</a>
        </div>
    </div>
</div>

{{--  Sub Menu  --}}
<div id="sub-menu" class="ui vertical segment">
    <div class="ui container">
        @yield('header')
    </div>
</div>

{{--  Breadcrumb Section  --}}
<div id="breadcrumb" class="ui vertical segment">
    <div class="ui container">
        <div class="ui segment">
            @yield('breadcrumb')
        </div>
    </div>
</div>

{{--  Main Section  --}}
<div id="main" class="ui vertical segment">
    <div class="ui stackable grid container">
        <div class="doubling two column row">
            {{--  Left Nav  --}}
            <div class="four wide column">
                <div class="ui two column equal height grid">
                    {{--  Menu  --}}
                    <div class="ten wide tablet sixteen wide computer column">
                        <div id="left-nav" class="ui vertical fluid menu">
                            {{--  Dashboard  --}}
                            <div class="first item">@lang('backend.nav.menu')</div>
                            <a class="{{ Request::is('backend') ? 'active' : '' }} item" href="{{ route('backend.dashboard') }}">
                                <i class="th icon"></i>
                                @lang('backend.nav.dashboard')
                            </a>

                            {{--  Users  --}}
                            <div class="item">
                                <div class="header">@lang('backend.nav.user')</div>
                                <div class="menu">
                                    <a class="{{ Request::is('backend/users') ? 'active' : '' }} item" href="{{ route('backend.users.index') }}">
                                        <i class="user icon"></i>
                                        @lang('backend.nav.user')
                                    </a>
                                </div>
                            </div>

                            {{--  Event  --}}
                            <div class="item">
                                <div class="header">@lang('backend.nav.event')</div>
                                <div class="menu">
                                    <a class="{{ Request::is('backend/events') | Request::is('backend/events/*') ? 'active' : '' }} item" href="{{ route('backend.events.index') }}">
                                        <i class="calendar icon"></i>
                                        @lang('backend.nav.event')
                                    </a>
                                    <a class="{{ Request::is('backend/event_categories') | Request::is('backend/event_categories/*') ? 'active' : '' }} item" href="{{ route('backend.event_categories.index') }}">
                                        <i class="tag icon"></i>
                                        @lang('backend.nav.eventCategory')
                                    </a>
                                </div>
                            </div>

                            {{--  News  --}}
                            <div class="item">
                                <div class="header">@lang('backend.nav.news')</div>
                                <div class="menu">
                                    <a class="{{ Request::is('backend/news') | Request::is('backend/news/*') ? 'active' : '' }} item" href="{{ route('backend.news.index') }}">
                                        <i class="file icon"></i>
                                        @lang('backend.nav.news')
                                    </a>
                                    <a class="{{ Request::is('backend/news_categories') | Request::is('backend/news_categories/*') ? 'active' : '' }} item" href="{{ route('backend.news_categories.index') }}">
                                        <i class="tag icon"></i>
                                        @lang('backend.nav.newsCategory')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{--  Control Panel  --}}
                    <div id="control-panel" class="six wide tablet sixteen wide computer column">
                        @yield('menu')
                    </div>
                </div>
            </div>

            {{--  Content  --}}
            <div class="twelve wide column">
                @yield('content')
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/semantic.min.js') }}"></script>
<script>
$(function() {
    $('.ui.checkbox').checkbox();
    $('.field .ui.dropdown').dropdown({
        allowAdditions: true
    });
});
</script>
@yield('script')
</body>
</html>
