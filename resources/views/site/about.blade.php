@extends('site.layout.default')

@section('title', '關於我們')

@section('content')
<div class="ui stackable grid">
    <div id="leftSideBar" class="four wide column">
        <div class="ui sticky">
            <div class="ui background segment">
                <div class="ui secondary vertical fluid menu">
                    <a class="item" href="#section1">簡介</a>
                    <a class="item" href="#section2">宗旨</a>
                    <a class="item" href="#section3">聯絡我們</a>
                </div>
            </div>
        </div>
    </div>

    <div class="twelve wide column">
        <div class="ui center aligned inverted segment">
            <p>關於我們</p>
        </div>

        {{--  section1  --}}
        <div id="section1" class="ui segment">
            <div class="ui ribbon huge label">簡介</div>
            <p>Line 1</p>
            <p>Line 2</p>
            <p>Line 3</p>
            <p>Line 4</p>
        </div>

        {{--  section2  --}}
        <div id="section2" class="ui segment">
            <div class="ui ribbon huge label">宗旨</div>
            <div class="ui medium orange header">Header 1</div>
            <p>Line 1</p>
            <div class="ui medium orange header">Header 2</div>
            <p>Line 2</p>
            <div class="ui medium orange header">Header 3</div>
            <p>Line 3</p>
            <div class="ui medium orange header">Header 4</div>
            <p>Line 4</p>
        </div>

        {{--  section4  --}}
        <div id="section3" class="ui segment">
            <div class="ui ribbon huge label">聯絡我們</div>
            <p><i class="envelope icon"></i>Address Here</p>
            <p><i class="phone icon"></i>電話：+852 0000 0000</p>
            <p><i class="info icon"></i>查詢：<a href="mailto:abcdef@mail.com">Email Here</a></p>
            <p><i class="facebook icon"></i>Facebook：<a href="http://www.facebook.com/">Link Here</a></p>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('.ui.sticky').sticky({
        offset: 50,
        context: '#leftSideBar'
    });
});
</script>
@endsection