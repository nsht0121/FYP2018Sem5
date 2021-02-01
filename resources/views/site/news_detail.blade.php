@extends('site.layout.default')

@section('title', $news->title)

@section('content')
<div class="sixteen wide column">
    <div class="ui segment">
        <img src="{{ asset($news->imagepath) }}">
    </div>

    <div class="ui segment">
        <h1>{{ $news->title }}</h1>
        {!! $news->content !!}
    </div>
</div>
@endsection