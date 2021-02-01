@extends('site.layout.default')

@section('title', '活動報名')

@section('content')
<div class="ui center aligned inverted segment">
    <p>活動報名</p>
</div>

<div class="sixteen wide column">
    <div class="ui segment">        
        <div class="ui divided items">
            @isset($events)
                @forelse ($events as $e)
                <div class="item">
                    <div class="image"><img src=""></div>
                    <div class="content">
                        <a class="header" href="{{ route('site.event_detail', $e->slug) }}">{{ $e->title }}</a>

                        <div class="meta">
                            <span>16/4/2018</span>
                        </div>

                        <div class="description">
                            標籤：
                            @foreach ($e->eventCategories as $ec)
                            <a href="{{ route('site.event_category', $ec->slug) }}" class="ui label">{{ $ec->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @empty
                <div class="item">No Items</div>
                @endforelse
            @else
            <div class="item">No Items</div>
            @endisset
        </div>
    </div>

    <div class="ui center aligned grid">
        <div class="column">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection
