@extends('layout.management.template')

@section('title', 'Công việc')

@section('content')
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Tiêu đề</label>
            <p>{{$job->title}}</p>
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
            <textarea class="form-control" rows="10">{{$job->describe}}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Hạn cuối</label>
            <p>{{ date_format($job->deadline,"d-m-Y") }}</p>
        </div>
        <div class="form-group">
            <a href="{!! route('companies.index') !!}" class="btn btn-primary">Trở về</a>
        </div>
    </form>
@endsection