<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    {{-- Meta --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | @lang('site.name')</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}"/>

    {{-- Styles --}}
    <link href="{{ asset('css/semantic.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>

<body>
<div class="ui left inverted vertical menu sidebar">
    <div class="item">1</div>
    <div class="item">2</div>
    <div class="item">3</div>
</div>

<div class="pusher">
    {{--  Header  --}}
    <header id="header">
        <a class="logo" href="{{ route('site.home') }}"><img src="{{ asset('images/logo.png') }}"></a>
        <div class="top">
            <div class="ui borderless menu mobile only">
                <div id="sidebar-toggler" class="link item"><i class="bars icon"></i></div>
                <div class="right menu">
                    <div class="link item"><i class="user icon"></i></div>
                </div>
            </div>
            <div class="ui borderless menu mobile hidden">
                <div class="ui container">
                    <div class="right menu">
                        @auth
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('backend.dashboard') }}" class="active item">管理系統</a>
                            @endif
                            <div class="item">歡迎！<i class="user icon"></i>{{ Auth::user()->username }}</div>
                            {!! Form::open(['method' => 'POST', 'route' => ['logout'], 'class' => 'item']) !!}
                            {!! Form::submit('登出', ['class' => 'logout item']) !!}
                            {!! Form::close() !!}
                        @else
                            <a href="{{ route('register') }}" class="{{ Request::is('register') ? 'active ' : '' }}item">註冊</a>
                            <a href="{{ route('login') }}" class="{{ Request::is('login') ? 'active ' : '' }}item">登入</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <div class="bot">
            <div class="ui borderless menu mobile hidden">
                <div class="ui container">
                    <div class="right menu">
                        <a href="{{ route('site.home') }}" class="{{ Request::is('/') ? 'active ' : '' }}item">主頁</a>
                        <a href="{{ route('site.news') }}" class="{{ Request::is('news') ? 'active ' : '' }}item">最新資料</a>
                        <a href="{{ route('site.event') }}" class="{{ Request::is('events') ? 'active ' : '' }}item">活動報名</a>
                        <a href="{{ route('site.about') }}" class="{{ Request::is('about') ? 'active ' : '' }}item">關於我們</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{--  Body  --}}
    <main id="main">
        <div class="ui container">
            @yield('content')
        </div>
    </main>

    {{--  Footer  --}}
    <footer id="footer">
        <div class="ui vertical segment">
            <div class="ui container">
                <div class="ui equal height stackable grid">
                    {{-- Sitemap --}}
                    <div class="four wide column">
                        <h4 class="ui inverted header">快速鏈接</h4>
                        <div class="ui divider"></div>
                        <div class="ui inverted list">
                            <a href="{{ route('site.about', ['#association']) }}" class="item">關於我們</a>
                            <a href="#" class="item">聯絡我們</a>
                        </div>
                    </div>
                    {{-- Contact Info --}}
                    <div class="six wide column">
                        <h4 class="ui inverted header">聯絡資料</h4>
                        <div class="ui divider"></div>
                        <div class="ui inverted list">
                            <div class="item">
                                <i class="envelope icon"></i>
                                <div class="content">
                                    <div class="header">地址</div>
                                    <div class="description">地址......</div>
                                </div>
                            </div>
                            <div class="item">
                                <i class="phone icon"></i>
                                <div class="content">
                                    <div class="header">電話</div>
                                    <div class="description">+852 0000 0000</div>
                                </div>
                            </div>
                            <div class="item">
                                <i class="info icon"></i>
                                <div class="content">
                                    <div class="header">查詢</div>
                                    <div class="description"><a href="mailto:abcdef@mail.com">abcdef@mail.com</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Disclaimer --}}
                    <div class="four wide column">
                        <h4 class="ui inverted header">其他資料</h4>
                        <div class="ui divider"></div>
                        <div class="ui inverted list">
                            <a class="item">免責條款</a>
                            <a class="item">個人資料政策</a>
                        </div>
                    </div>
                    {{-- Copyright --}}
                    <div class="sixteen wide center aligned column">
                        <p class="copyright"><i class="copyright outline icon"></i>2018 - XXXXXX</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

{{-- Scripts --}}
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/semantic.min.js') }}"></script>
@yield('script')
</body>
</html>
