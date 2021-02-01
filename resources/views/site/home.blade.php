@extends('site.layout.default')
@section('page', 'home')
@section('title', '網站名')

@section('content')
<div id="home" class="ui stackable grid">
    {{--  Welcome  --}}
    <div class="ten wide column">
        <div class="ui segments">
            <div class="ui top attached block header">
                <i class="hand peace outline alternate icon"></i>歡迎來臨
            </div>
            <div class="ui bottom attached segment">
                <p>歡迎來到此網站。你可以在這裹找到有關注XXXX的資訊</p>
            </div>
        </div>
    </div>

    {{--  Test  --}}
    <div class="six wide column">
        <div class="ui segments">
            <div class="ui top attached block header">
                <i class="edit alternate icon"></i>自我評估
            </div>
            <div class="ui bottom attached center aligned segment">
                <h2 class="ui icon header">
                    <i class="circular wrench icon"></i>
                    <div class="content">
                        此功能暫未開放
                    </div>
                </h2>
            </div>
        </div>
    </div>

    {{--  Latest News  --}}
    <div class="ten wide column">
        <div class="ui segments">
            <div class="ui top attached block header">
                <i class="bell outline icon"></i>最新消息
            </div>
            <div class="ui bottom attached segment">
                <div class="ui divided items">
                    @foreach ($news as $n)
                        <div class="item">
                            <div class="content">
                                <a class="header" href="{{ route('site.news_detail', $n->slug) }}">{{ $n->title }}</a>
                                <div class="description">
                                    <p>[{{ $n->updated_at->format('d/m/Y') }}]
                                        @foreach ($n->newsCategories()->take(4)->get() as $nc)
                                            <a href="{{ route('site.news_category', $nc->slug) }}" class="ui label">{{ $nc->name }}</a>
                                        @endforeach
                                        @if ($n->newsCategories()->count() > 4)
                                            <a class="ui disabled label">...</a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{--  Support Network  --}}
    <div class="six wide column">
        <div class="ui segments">
            <div class="ui top attached block header">
                <i class="handshake outline icon"></i>支援
            </div>
            <div class="ui bottom attached segment">
                <p>你在尋找援助嗎？我們有專業人士可以幫助你解決問題。</p>
                <p>歡迎聯絡我們：<a href="mailto:abcdef@mail.com">abcdef@mail.com</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
