@extends('layout.management.template')

@section('title', 'Thông tin cá nhân')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            {!! Form::model($profile, ['route' => 'companies.profile.update', 'method' => 'post', 'class' => 'form-horizontal']) !!}
            <div class="form-group row">
                <label class="col-sm-3 control-label">Tên</label>
                <div class="col-sm-9 {!! $errors->has('name') ? 'has-error' : '' !!}">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block"><b>{!! $errors->first('name') !!}</b></span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9 {!! $errors->has('email') ? 'has-error' : '' !!}">
                    {!! Form::text('email', $profile->account->email, ['class' => 'form-control']) !!}
                    @if ($errors->has('email'))
                        <span class="help-block"><b>{!! $errors->first('email') !!}</b></span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Mật khẩu</label>
                <div class="col-sm-9 {!! $errors->has('password') ? 'has-error' : '' !!}">
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    @if ($errors->has('password'))
                        <span class="help-block"><b>{!! $errors->first('password') !!}</b></span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Xác thực mật khẩu</label>
                <div class="col-sm-9 {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block"><b>{!! $errors->first('password_confirmation') !!}</b></span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Địa chỉ</label>
                <div class="col-sm-9 {!! $errors->has('address_id') ? 'has-error' : '' !!}">
                    {!! Form::select('address_id', $address, null, ['class' => 'form-control']) !!}
                    @if ($errors->has('address_id'))
                        <span class="help-block"><b>{!! $errors->first('address_id') !!}</b></span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Điện thoại</label>
                <div class="col-sm-9 {!! $errors->has('phone') ? 'has-error' : '' !!}">
                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('phone'))
                        <span class="help-block"><b>{!! $errors->first('phone') !!}</b></span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Giới thiệu</label>
                <div class="col-sm-9 {!! $errors->has('about') ? 'has-error' : '' !!}">
                    {!! Form::text('about', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('about'))
                        <span class="help-block"><b>{!! $errors->first('about') !!}</b></span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <button class="btn btn-primary">Cập nhật</button>
                    <a href="{!! route('companies.index') !!}" class='btn btn-primary'>Trở về</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-4">
            <form id="update-avatar" method="post" enctype="multipart/form-data">
                <div class="text-center">
                    <img id="previewing" src="{!! asset($profile->avatar) !!}" class="img-responsive img-thumbnail text-center" alt="User Image" />
                </div>
                <hr>
                <input type="file" name="avatar" id="avatar"/>
                <div id="message-error"></div>
                <button id="btn-update-avatar" class="btn btn-primary btn-update">Thay đổi</button>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#btn-update-avatar').click(function(){
                if (!$('#avatar').val()) {
                    $("#message-error").html("<p class='help-block'>Vui lòng chọn ảnh</p>");
                    return false;
                }
            });

            $("#avatar").change(function() {
                function loadImage(e) {
                    $('#previewing').attr('src', e.target.result);
                };

                var typeImage = this.files[0].type;
                if (typeImage == 'image/jpeg' || typeImage == 'image/png') {
                    var reader = new FileReader();
                    reader.onload = loadImage;
                    reader.readAsDataURL(this.files[0]);
                    $("#message-error").empty();
                    $('#btn-update-avatar').attr("disabled",false);
                } else {
                    $('#previewing').attr("src","{{ asset('images/icons/image_not_found.jpg') }}");
                    $("#message-error").empty();
                    $("#message-error").html("<p class='help-block'>Vui lòng chọn ảnh có định dạng png hoặc jpg</p>");
                    $('#btn-update-avatar').attr("disabled",true);
                }
            });
        });
    </script>
@endsection