@extends('layout.site.template-login')

@section('content')
    <div class="container">
        <div class="row">
            {!! Form::open(['route' => 'contact', 'method' => 'post', 'class' => 'col-md-4 col-md-offset-4 form-login'])  !!}
            @if (session('message'))
                <div class="alert alert-success">
                    <p class="text-success">{{ session('message') }}</p>
                </div>
            @endif
            <div class="form-group ">
                {!! Form::label('', 'Họ tên') !!}
                <div class="{!! $errors->has('name') ? 'has-error' : '' !!}">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{!! $errors->first('name') !!}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group ">
                {!! Form::label('', 'Email') !!}
                <div class="{!! $errors->has('email') ? 'has-error' : '' !!}">
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
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