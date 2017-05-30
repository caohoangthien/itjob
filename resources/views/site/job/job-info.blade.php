@extends('layout.site.template')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <a href="{!! route('home-site') !!}" class="btn btn-default"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                    </div>
                    <div class="panel-body job-infor">
                        <h4>{{ $job->title }}</h4>
                        <h4>Công ty</h4>
                        <p>{{ $job->company->name }}</p>
                        <h4>Nơi làm việc</h4>
                        <p>{{ $job->address->name }}</p>
                        <h4>Mô tả công việc</h4>
                        <textarea class="form-control" rows="18" disabled="">{{ $job->describe }}</textarea>
                        <h4>Mức lương</h4>
                        <p>{{ $job->salary->salary }}</p>
                        <h4>Số lượng</h4>
                        <p>{{ $job->quantity }}</p>
                        <h4>Kỹ năng</h4>
                        @foreach($job->skills as $skill)
                            <p>{{$skill->name}}</p>
                        @endforeach
                        <h4>Trình độ</h4>
                        @foreach($job->levels as $level)
                            <p>{{$level->name}}</p>
                        @endforeach
                        <h4>Hạn cuối</h4>
                        <p>{{ $job->deadline->format('d-m-Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <a class="btn btn-default full-with">Tìm kiếm việc làm</a>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'jobs.search', 'method' => 'post']) !!}
                        <div class="form-group">
                            <label>Tên công việc</label>
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>Tên công ty</label>
                            {!! Form::text('company', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>Địa điểm</label>
                            {!! Form::select('address_id', $address_array, null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>Kỹ năng</label>
                            @foreach($skills as $skill)
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('skills_id[]', $skill->id) !!} {!! $skill->name !!}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>Cấp độ</label>
                            @foreach($levels as $level)
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('levels_id[]', $level->id) !!} {!! $level->name !!}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>Mức lương</label>
                            @foreach($salaries as $salary)
                                <div class="checkbox">
                                    <label>
                                        {!! Form::radio('salary_id', $salary->id) !!} {!! $salary->salary !!}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection