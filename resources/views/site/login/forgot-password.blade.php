@extends('layout.site.template-login')

@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 183px">
            {!! Form::open(['route' => 'forgot-password', 'method' => 'post', 'class' => 'col-md-4 col-md-offset-4 form-login'])  !!}
            @if (session('message'))
                <div class="alert alert-success">
                    <p class="text-success">{{ session('m') }}</p>
                </div>
            @endif
            <div class="form-group ">
                {!! Form::label('', 'Mật khẩu sẽ được gởi về email của bạn.') !!}
                <div class="{!! $errors->has('email') ? 'has-error' : '' !!}">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                        </div>
                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{!! $errors->first('email') !!}</strong>
                        </span>
                    @endif
                </div>
            </div>
            {!! Form::submit('Ok', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection