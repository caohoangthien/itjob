@extends('layout.management.template')

@section('title', 'Thông tin công ty')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            {!! Form::model($company, ['class' => 'form-horizontal'])  !!}
            <div class="form-group row">
                <label class="col-sm-3 control-label">Công ty</label>
                <div class="col-sm-9">
                    {!! Form::text('name', null, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                    {!! Form::text('email', $company->account->email, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Địa chỉ</label>
                <div class="col-sm-9">
                    {!! Form::text('address_id', $company->address->name, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div><div class="form-group row">
                <label class="col-sm-3 control-label">Số điện thoại</label>
                <div class="col-sm-9">
                    {!! Form::text('phone', null, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Giới thiệu</label>
                <div class="col-sm-9">
                    {!! Form::textarea('about', null, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <a href="{!! route('admins.index') !!}" class='btn btn-primary'>Trở về</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-4">
            <div class="text-center">
                <img id="previewing" src="{!! asset($company->avatar) !!}" class="img-responsive img-thumbnail text-center" alt="User Image" />
            </div>
            <hr>
        </div>
    </div>
@endsection