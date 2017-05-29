@extends('layout.management.template')

@section('title', 'Công việc')

@section('content')
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">ID</label>
            <p>{{$job->id}}</p>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Tiêu đề</label>
            <p>{{$job->company->name}}</p>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Công ty</label>
            <p>{{$job->company->name}}</p>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Địa chỉ</label>
            <p>{{$job->address->name}}</p>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Mức lương</label>
            <p>{{$job->salary->salary}}</p>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Số lượng</label>
            <p>{{$job->quantity}}</p>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Kỹ năng</label>
            @foreach($job->skills as $skill)
                <p>{{$skill->name}}</p>
            @endforeach
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Cấp độ</label>
            @foreach($job->levels as $level)
                <p>{{$level->name}}</p>
            @endforeach
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả</label>
            <p>{{$job->describe}}</p>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Trạng thái</label>
            <p>{{$job->status}}</p>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ngày đăng</label>
            <p>{{$job->created_at}}</p>
        </div>
        <div class="form-group">
            <a href="{!! route('admins.job.list') !!}" class="btn btn-primary">Trở về</a>
        </div>
    </form>
@endsection