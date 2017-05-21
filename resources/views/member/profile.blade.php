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
                <div class="col-sm-9">
                    {!! Form::text('name', null, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                    {!! Form::text('email', $profile->account->email, ['class' => 'form-control', 'disabled']) !!}
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
                    {!! Form::text('gender', $profile->gender == 1 ? 'Nam' : 'Nữ', ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Địa chỉ</label>
                <div class="col-sm-9">
                    {!! Form::text('address_id', $profile->address->name, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label">Kĩ năng</label>
                <div class="col-sm-9">
                    @foreach($profile->skills as $skill)
                        {!! Form::text('phone', $skill->name, ['class' => 'form-control', 'disabled']) !!}
                    @endforeach
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
                    <a href="{!! route('members.profile.edit') !!}" class='btn btn-primary'>Sửa</a>
                    <a href="{!! route('members.index') !!}" class='btn btn-primary'>Trở về</a>
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
                        url: '{{route('members.image.update')}}',
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