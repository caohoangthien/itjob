@extends('layout.management.template')

@section('title', 'Thông tin thành viên')

@section('content')
    <div class="row">
        <div class="col-md-6">
            {!! Form::model($member, ['class' => 'form-horizontal'])  !!}
            <div class="form-group row show-member">
                <label class="col-sm-3 control-label">Hình ảnh</label>
                <div class="col-sm-9">
                    <img src="{!! asset($member->avatar) !!}" class="img-responsive img-thumbnail text-center" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Tên</label>
                <div class="col-sm-9">
                    {!! Form::text('name', null, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                    {!! Form::text('email', $member->account->email, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Điện thoại</label>
                <div class="col-sm-9">
                    {!! Form::text('phone', null, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Ngày sinh</label>
                <div class="col-sm-9">
                    {!! Form::text('birthday', null, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Giới tính</label>
                <div class="col-sm-9">
                    {!! Form::text('gender', $member->gender == 1 ? 'Nam' : 'Nữ', ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Địa chỉ</label>
                <div class="col-sm-9">
                    {!! Form::text('address_id', $member->address->name, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Kĩ năng</label>
                <div class="col-sm-9">
                    @foreach($member->skills as $skill)
                        {!! Form::text('phone', $skill->name, ['class' => 'form-control', 'disabled']) !!}
                    @endforeach
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Giới thiệu</label>
                <div class="col-sm-9">
                    {!! Form::text('about', null, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <a href="{!! route('admins.member.list') !!}" class='btn btn-primary'>Trở về</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            <div class="text-center">
                <iframe src="{{ asset($member->cv)}}" width="500" height="500"></iframe>
            </div>
            <hr>
        </div>
    </div>
@endsection