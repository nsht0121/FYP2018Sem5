@extends('site.layout.default')

@section('title', '重設密碼')

@section('content')
<div class="ui stackable centered grid">
    <div class="twelve wide tablet eight wide computer column">
        <div class="ui top attached grey inverted center aligned segment">
            <h4 class="ui header">重設密碼</h4>
        </div>
        <div class="ui bottom attached segment">
            {!! Form::open(['class' => 'ui form error', 'method' => 'POST', 'route' => ['password.email']]) !!}

                <div class="field">
                    {!! Form::label('email', '電郵地址') !!}
                    {!! Form::text('email') !!}
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
                
                {!! Form::submit('找回密碼', ['class' => 'ui primary button']) !!}

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
