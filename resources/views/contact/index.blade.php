@extends('layout.site.template-login')

@section('content')
    <div class="container">
        <div class="row">
            {!! Form::open(['route' => 'contact', 'method' => 'post', 'class' => 'col-md-4 col-md-offset-4 form-login'])  !!}
            <h4 class="text-center"><b>THÔNG TIN LIÊN HỆ</b></h4>
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
            <div class="form-group ">
                {!! Form::label('', 'Nội dung') !!}
                <div class="{!! $errors->has('content') ? 'has-error' : '' !!}">
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 10]) !!}
                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{!! $errors->first('content') !!}</strong>
                        </span>
                    @endif
                </div>
            </div>
            {!! Form::submit('Gửi', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection