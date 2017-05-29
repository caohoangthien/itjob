@extends('layout.site.template')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <a href="{!! route('home-site') !!}" class="btn btn-default"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                    </div>
                    <div class="panel-body company-infor">
                        <h4>Hình đại diện</h4>
                        <img src="{!! asset($company->avatar) !!}" class="text-center" height="100" />
                        <h4>Công ty</h4>
                        <p>{{ $company->name }}</p>
                        <h4>Điạ chỉ</h4>
                        <p>{{ $company->address->name }}</p>
                        <h4>Điện thoại</h4>
                        <p>{{ $company->phone }}</p>
                        <h4>Giới thiệu</h4>
                        <p>{{ $company->about }}</p>
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
                            <label>Mức lương</label>
                            @foreach($salaries as $salary)
                                <div class="checkbox">
                                    <label>
                                        {!! Form::radio('salary_id', $salary->id) !!} {!! $salary->salary !!}
                                    </label>
                                </div>
                            @endforeach
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
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection