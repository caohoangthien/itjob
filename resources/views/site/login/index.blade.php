@extends('layout.site.template-login')

@section('content')
<div class="container">
    <div class="row">
        {!! Form::open(['route' => ['login'], 'method' => 'post', 'class' => 'col-md-4 col-md-offset-4 form-login'])  !!}
        <img src="{!! asset('images/icons/signin.png') !!}" width="100" class="img-responsive"/>

        @if (session('error'))
        <div class="alert alert-success">
            <p class="text-success">{{ session('error') }}</p>
        </div>
        @endif

        <div class="form-group ">
            {!! Form::label('', 'Email') !!}
            <div class="{!! $errors->has('email') ? 'has-error' : '' !!}">
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{!! $errors->first('email') !!}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group ">
            {!! Form::label('', 'Mật khẩu') !!}
            <div class="{!! $errors->has('password') ? 'has-error' : '' !!}">
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mật khẩu']) !!}
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{!! $errors->first('password') !!}</strong>
                </span>
                @endif
            </div>
        </div>

        {!! Form::submit('Đăng nhập', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection