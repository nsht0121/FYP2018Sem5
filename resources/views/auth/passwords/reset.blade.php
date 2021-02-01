@extends('site.layout.default')

@section('title', '重設密碼')

@section('content')
<div class="ui stackable centered grid">
    <div class="twelve wide tablet eight wide computer column">
        <div class="ui top attached grey inverted center aligned segment">
            <h4 class="ui header">重設密碼</h4>
        </div>
        <div class="ui bottom attached segment">
            {!! Form::open(['class' => 'ui form error', 'method' => 'POST', 'route' => ['password.request']]) !!}

                {!!Form::hidden('token', $token)!!}

                <div class="field">
                    {!! Form::label('email', '電郵地址') !!}
                    {!! Form::text('email') !!}
                </div>

                <div class="field">
                    {!! Form::label('password', '密碼') !!}
                    {!! Form::password('password') !!}
                </div>

                <div class="field">
                    {!! Form::label('password_confirmation', '重複密碼') !!}
                    {!! Form::password('password_confirmation') !!}
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
                
                {!! Form::submit('重設密碼', ['class' => 'ui primary button']) !!}

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
