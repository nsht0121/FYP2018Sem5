@extends('site.layout.default')

@section('title', '登入')

@section('content')
<div class="ui stackable centered grid">
    <div class="twelve wide tablet eight wide computer column">
        <div class="ui top attached inverted center aligned segment">
            <h4 class="ui header">登入</h4>
        </div>
        <div class="ui bottom attached segment">
            {!! Form::open(['class' => 'ui form error', 'method' => 'POST', 'route' => ['login']]) !!}

                <div class="field">
                    {!! Form::label('email', '電郵地址') !!}
                    {!! Form::text('email') !!}
                </div>

                <div class="field">
                    {!! Form::label('password', '密碼') !!}
                    {!! Form::password('password') !!}
                </div>

                @if ($errors->any())
                <div class="ui error message">
                    <ul class="ui list">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <div class="ui one column center aligned grid">
                    <div class="column">
                        {!! Form::submit('登入', ['class' => 'ui primary button']) !!}
                    </div>
                </div>
            {!! Form::close() !!}

            <div class="ui info message">
                <i class="icon help"></i>不能登入？<a href="{{ route('password.request') }}">重設密碼</a>
            </div>
        </div>
    </div>
</div>
@endsection
