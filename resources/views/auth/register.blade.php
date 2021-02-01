@extends('site.layout.default')

@section('title', '註冊')

@section('content')
<div class="ui stackable centered grid">
    <div class="twelve wide tablet eight wide computer column">
        <div class="ui top attached inverted center aligned segment">
            <h4 class="ui header">註冊</h4>
        </div>
        <div class="ui attached segment">
            {!! Form::open(['class' => 'ui form error', 'method' => 'POST', 'route' => ['register']]) !!}

                <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                    {!! Form::label('email', '電郵地址', ['class' => 'required']) !!}
                    {!! Form::email('email') !!}
                </div>

                <div class="field {{ $errors->has('username') ? 'error' : '' }}">
                    {!! Form::label('username', '用戶名稱', ['class' => 'required']) !!}
                    {!! Form::text('username') !!}
                </div>

                <div class="field {{ $errors->has('password') ? 'error' : '' }}">
                    {!! Form::label('password', '密碼', ['class' => 'required']) !!}
                    {!! Form::password('password') !!}
                </div>

                <div class="field">
                    {!! Form::label('password_confirmation', '重複密碼') !!}
                    {!! Form::password('password_confirmation', ['class' => 'required']) !!}
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
                        <div class="field">
                            {!! NoCaptcha::display() !!}
                        </div>

                        {!! Form::submit('確認註冊', ['class' => 'ui primary button']) !!}
                    </div>
                </div>

            {!! Form::close() !!}

            <div class="ui info message">
                <i class="icon help"></i>已有帳戶？<a href="{{ route('login') }}">登入</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
{!! NoCaptcha::renderJs() !!}
@endsection