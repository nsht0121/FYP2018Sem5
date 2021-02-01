@extends('site.layout.default')

@section('title', '最新資料')

@section('content')
<div class="sixteen wide column">
    <div class="ui center aligned inverted segment">
        <p>最新資料</p>
    </div>

    <div class="ui segment">        
        <div class="ui divided items">
            @isset($news)
                @forelse ($news as $n)
                    <div class="item">
                        @if ($n->thumbnail)
                            <a class="image" href="{{ route('site.news_detail', $n->slug) }}"><img src="{{ asset($n->thumbnail) }}"></a>
                        @endif
                        <div class="content">
                            <a class="header" href="{{ route('site.news_detail', $n->slug) }}">{{ $n->title }}</a>

                            <div class="meta">
                                <span>16/4/2018</span>
                            </div>

                            <div class="description">
                                <p>{{ $n->content }}</p>
                            </div>

                            <div class="extra">
                                標籤：
                                @forelse ($n->newsCategories as $nc)
                                    <a href="{{ route('site.news_category', $nc->slug) }}" class="ui teal label">{{ $nc->name }}</a>
                                @empty
                                    <div class="ui grey label">未分類</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="item">沒有新消息</div>
                @endforelse
            @else
                <div class="item">沒有新消息</div>
            @endisset
        </div>
    </div>
</div>

<div class="sixteen wide column">
    {{ $news->links() }}
</div>
@endsection
