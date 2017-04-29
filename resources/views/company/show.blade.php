@extends('layout.management.template')

@section('title', 'Thông tin công ty')

@section('content')
    <form>
        <div class="form-group">
            <img style="height: 150px;" src="{{ asset($company->avatar) }}" class="img-thumbnail">
        </div>
        <div class="form-group">
            <label>Tên công ty</label>
            <p>{{ $company->name }}</p>
        </div>
        <div class="form-group">
            <label>Email</label>
            <p>{{ $company->account->email }}</p>
        </div>
        <div class="form-group">
            <label>Địa chỉ</label>
            <p>{{ $company->address->name }}</p>
        </div>
        <div class="form-group">
            <label>Điện thoại</label>
            <p>{{ $company->phone }}</p>
        </div>
        <div class="form-group">
            <label>Giới thiệu</label>
            <p>{{ $company->about }}</p>
        </div>
        <a href="{!! route('admins.index') !!}" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Trở về</a>
    </form>
@endsection