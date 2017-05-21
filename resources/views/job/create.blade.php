@extends('layout.management.template')

@section('title', 'Đăng tin mới')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @endif
    {!! Form::open(['route' => 'jobs.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
    <div class="form-group row">
        <label class="col-sm-3 control-label">Tiêu đề</label>
        <div class="col-sm-9 {!! $errors->has('title') ? 'has-error' : '' !!}">
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
            @if ($errors->has('title'))
                <span class="help-block"><b>{!! $errors->first('title') !!}</b></span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label">Kỹ năng</label>
        <div class="col-sm-9 {!! $errors->has('skills_id') ? 'has-error' : '' !!}">
            @foreach($skills as $skill)
                {!! Form::checkbox('skills_id[]', $skill->id) !!} {!! $skill->name !!}<br>
            @endforeach
            @if ($errors->has('skills_id'))
                <span class="help-block"><b>{!! $errors->first('skills_id') !!}</b></span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label">Mức lương</label>
        <div class="col-sm-9 {!! $errors->has('salary_id') ? 'has-error' : '' !!}">
            @foreach($salaries as $salary)
                {!! Form::radio('salary_id', $salary->id) !!} {!! $salary->salary !!}<br>
            @endforeach
            @if ($errors->has('salary_id'))
                <span class="help-block"><b>{!! $errors->first('salary_id') !!}</b></span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label">Cấp độ</label>
        <div class="col-sm-9 {!! $errors->has('levels_id') ? 'has-error' : '' !!}">
            @foreach($levels as $level)
                {!! Form::checkbox('levels_id[]', $level->id) !!} {!! $level->name !!}<br>
            @endforeach
            @if ($errors->has('levels_id'))
                <span class="help-block"><b>{!! $errors->first('levels_id') !!}</b></span>
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
        <label class="col-sm-3 control-label">Số lượng</label>
        <div class="col-sm-9 {!! $errors->has('quantity') ? 'has-error' : '' !!}">
            {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
            @if ($errors->has('quantity'))
                <span class="help-block"><b>{!! $errors->first('quantity') !!}</b></span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 control-label">Mô tả công việc</label>
        <div class="col-sm-9 {!! $errors->has('describe') ? 'has-error' : '' !!}">
            {!! Form::textarea('describe', null, ['class' => 'form-control']) !!}
            @if ($errors->has('describe'))
                <span class="help-block"><b>{!! $errors->first('describe') !!}</b></span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Hạn cuối</label>
        <div class="col-sm-9 {!! $errors->has('deadline') ? 'has-error' : '' !!}">
            {!! Form::text('deadline', null, ['class' => 'form-control', 'id' => 'datepicker-backend', 'placeholder' => 'Hạn cuối']) !!}
            <span class="help-block">
                <strong>{!! $errors->first('deadline') !!}</strong>
            </span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3"></div>
        <div class="col-sm-9">
            <button class="btn btn-primary">Đăng tin</button>
            <a href="{!! route('admins.index') !!}" class='btn btn-primary'>Trở về</a>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#datepicker-backend").datepicker({ dateFormat: 'dd-mm-yy' });
        })
    </script>
@endsection