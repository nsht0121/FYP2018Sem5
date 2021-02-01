@extends('site.layout.default')

@section('title', $event->title)

@section('content')
<div class="sixteen wide column">
    <div class="ui segment">
        <h1>{{ $event->title }}</h1>
        {!! $event->description !!}
    </div>

    <div class="ui segment">
        <p>可加入的組別</p>
        @forelse ($event->eventClasses as $ec)
            <div class="ui segment">
                <p>{{ $ec->name }}</p>
                <p>參與人數：{{ ($ec->quota > 0) ? $ec->users()->count()."/".$ec->quota : $ec->users()->count() }}</p>

                @guest
                    {!! Form::open(['method' => 'POST', 'route' => ['site.event_join', $event->slug, $ec->id]]) !!}
                    {!! Form::submit('請先登入', ['class' => 'ui button']) !!}
                    {!! Form::close() !!}
                @else
                    @if ($ec->users()->find(Auth::user()->id))
                        {!! Form::open(['method' => 'POST', 'route' => ['site.event_join', $event->slug, $ec->id]]) !!}
                        {!! Form::submit('離開', ['class' => 'ui yellow button']) !!}
                        {!! Form::close() !!}
                    @else
                        @if ($ec->quota === 0 || $ec->users()->count() < $ec->quota)
                            {!! Form::open(['method' => 'POST', 'route' => ['site.event_join', $event->slug, $ec->id]]) !!}
                            {!! Form::submit('參與', ['class' => 'ui blue button']) !!}
                            {!! Form::close() !!}
                        @else
                            <button class="ui button disabled">沒有空位</button>
                        @endif
                    @endif
                @endguest
            </div>
        @empty
            <p>No class</p>
        @endforelse
    </div>
</div>
@endsection