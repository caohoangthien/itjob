@extends('layout.management.template')

@section('title', 'Thông tin cá nhân')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            {!! Form::model($profile, ['class' => 'form-horizontal'])  !!}
            <div class="form-group row">
                <label class="col-sm-3 control-label">Tên</label>
                <div class="col-sm-9 {!! $errors->has('name') ? 'has-error' : '' !!}">
                    {!! Form::text('name', null, ['class' => 'form-control', 'disabled']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block"><b>{!! $errors->first('name') !!}</b></span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9 {!! $errors->has('email') ? 'has-error' : '' !!}">
                    {!! Form::text('email', auth()->user()->email, ['class' => 'form-control', 'disabled']) !!}
                    @if ($errors->has('email'))
                        <span class="help-block"><b>{!! $errors->first('email') !!}</b></span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <a href="{!! route('admins.profile.edit') !!}" class='btn btn-primary'>Sửa</a>
                    <a href="{!! route('admins.index') !!}" class='btn btn-primary'>Trở về</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-4">
            <form id="update-avatar" method="post" enctype="multipart/form-data">
                <div class="text-center">
                    <img id="previewing" src="{!! asset(auth()->user()->admin->avatar) !!}" class="img-responsive img-thumbnail text-center" alt="User Image" />
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