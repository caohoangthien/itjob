@extends('layout.site.template-login')

@section('content')
<div class="container">
    <div class="row">
        {!! Form::open(['route' => ['companies.signup'], 'method' => 'post', 'files' => true, 'class' => 'col-md-6 col-md-offset-3 form-login'])  !!}
        <img src="{!! asset('images/icons/company.png') !!}" class="img-responsive" style="margin: 15px auto" />

        @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
        @endif

        <div class="form-group ">
            {!! Form::label('', 'Công ty') !!}
            <div class="{!! $errors->has('name') ? 'has-error' : '' !!}">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tên công ty']) !!}
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

        <div class="form-group ">
            {!! Form::label('', 'Địa chỉ') !!}
            <div class="{!! $errors->has('address_id') ? 'has-error' : '' !!}">
                {!! Form::select('address_id', $address, null, ['class' => 'form-control']) !!}
                @if ($errors->has('address_id'))
                    <span class="help-block">
                    <strong>{!! $errors->first('address_id') !!}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group ">
            {!! Form::label('', 'Điện thoại') !!}
            <div class="{!! $errors->has('phone') ? 'has-error' : '' !!}">
                {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Điện thoại']) !!}
                @if ($errors->has('phone'))
                    <span class="help-block">
                    <strong>{!! $errors->first('phone') !!}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group ">
            {!! Form::label('', 'Giới thiệu') !!}
            <div class="{!! $errors->has('about') ? 'has-error' : '' !!}">
                {!! Form::textarea('about', null, ['class' => 'form-control', 'rows' => 10]) !!}
                @if ($errors->has('about'))
                    <span class="help-block">
                    <strong>{!! $errors->first('about') !!}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group ">
            {!! Form::label('', 'Hình ảnh') !!}
            <div class="{!! $errors->has('avatar') ? 'has-error' : '' !!}">
                {!! Form::file('avatar') !!}
                @if ($errors->has('avatar'))
                    <span class="help-block">
                    <strong>{!! $errors->first('avatar') !!}</strong>
                </span>
                @endif
            </div>
        </div>

        {!! Form::submit('Đăng kí', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection