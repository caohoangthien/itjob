@extends('layout.management.template')

@section('title', 'Thông tin cá nhân')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if ($action == 'edit')
                {!! Form::model($profile, ['route' => 'admins.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::model($profile, ['class' => 'form-horizontal'])  !!}
            @endif
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Tên</label>
                    <div class="col-sm-9 {!! $errors->has('name') ? 'has-error' : '' !!}">
                        {!! Form::text('name', null, ['class' => 'form-control', $action == 'edit' ? '' : 'disabled']) !!}
                        @if ($errors->has('name'))
                            <span class="help-block"><b>{!! $errors->first('name') !!}</b></span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9 {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::text('email', auth()->user()->email, ['class' => 'form-control', $action == 'edit' ? '' : 'disabled']) !!}
                        @if ($errors->has('email'))
                            <span class="help-block"><b>{!! $errors->first('email') !!}</b></span>
                        @endif
                    </div>
                </div>
                @if ($action == 'edit')
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Mật khẩu</label>
                        <div class="col-sm-9 {!! $errors->has('password') ? 'has-error' : '' !!}">
                            {!! Form::password('password', ['class' => 'form-control', $action == 'edit' ? '' : 'disabled']) !!}
                            @if ($errors->has('password'))
                                <span class="help-block"><b>{!! $errors->first('password') !!}</b></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label">Xác thực mật khẩu</label>
                        <div class="col-sm-9 {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
                            {!! Form::password('password_confirmation', ['class' => 'form-control', $action == 'edit' ? '' : 'disabled']) !!}
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block"><b>{!! $errors->first('password_confirmation') !!}</b></span>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        @if ($action == 'profile')
                            <a href="{!! route('admins.edit-profile') !!}" class='btn btn-primary'>Sửa</a>
                        @else
                            <button class="btn btn-primary">Cập nhật</button>
                        @endif
                            <a href="{!! route('admins.index') !!}" class='btn btn-primary'>Trở về</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-4">
            <form id="update-avatar" enctype="multipart/form-data">
                <div id="image_preview"><img id="previewing" src="{!! asset(auth()->user()->admin->avatar) !!}" class="img-responsive img-thumbnail" alt="User Image" /></div>
                <hr id="line">
                <input type="file" name="avatar" id="avatar" required />
                <button id="update-avatar" class="btn btn-primary btn-update">Thay đổi</button>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#update-avatar").on('submit',(function(e) {
                var x = new FormData(this);
                console.log(x);
            }));
        });
    </script>
@endsection