@extends('layout.site.template')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <a href="{!! route('home-site') !!}" class="btn btn-default"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                    </div>
                    <div class="panel-body" style="height: 975px">
                        <ul class="list-group">
                            @foreach($jobs as $job)
                                <li class="list-group-item">
                                    <p class="job-title"><a href="{!! route('jobs.search-title', $job->id) !!}">{{ str_limit($job->title, 70) }}</a></p>
                                    <p class="job-company"><a href="{!! route('company.infor', $job->company_id) !!}"><b>{{ $job->company->name }}</b></a> - <b>{{ $job->address->name }}</b></p>
                                    <p class="job-salary">{{ $job->salary->salary }} | Ngày đăng: {{ $job->created_at->format('d/m/Y') }} | Hạn cuối: {{ $job->deadline->format('d/m/Y') }}</p>
                                </li>
                            @endforeach
                            {{ $jobs->links() }}
                        </ul>
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