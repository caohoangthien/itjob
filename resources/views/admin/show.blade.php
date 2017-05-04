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
            <div class="text-center">
                <img id="previewing" src="{{ asset($profile->avatar) }}" class="img-responsive img-thumbnail text-center" alt="User Image" />
            </div>
            <hr>
            <h4>Thay đổi:</h4>
            <input type="file" name="avatar" id="avatar"/>
            <div id="message-error"></div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}
            });
            var oldImage = $('#previewing').attr('src').slice($('#previewing').attr('src').lastIndexOf('images'));
            function loadImage(e) {
                $('#previewing').attr('src', e.target.result);
            };
            $("#avatar").change(function(e) {
                var typeImage = this.files[0].type;
                if (typeImage == 'image/jpeg' || typeImage == 'image/png') {
                    var reader = new FileReader();
                    reader.onload = loadImage;
                    reader.readAsDataURL(this.files[0]);
                    $("#message-error").empty();
                    var formData = new FormData();
                    formData.append('file', this.files[0]);
                    formData.append('oldImage', oldImage);
                    $.ajax({
                        type: "POST",
                        url: '{{route('admins.image.update')}}',
                        data: formData,
                        cache : false,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.message == 'Success') {
                                oldImage = data.fileName;
                                $("#message-error").empty();
                                $("#message-error").html("<p class='help-block'>Cập nhật avatar thành công.</p>");
                            } else {
                                $("#message-error").empty();
                                $("#message-error").html("<p class='help-block'>Cập nhật avatar thất bại.</p>");
                            }
                        }
                    });
                } else {
                    $('#previewing').attr("src","{{ asset('images/icons/image_not_found.jpg') }}");
                    $("#message-error").empty();
                    $("#message-error").html("<p class='help-block'>Vui lòng chọn ảnh có định dạng png hoặc jpg</p>");
                }
            });
        });
    </script>
@endsection