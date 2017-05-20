@extends('layout.management.template')

@section('title', 'Sửa thông tin')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            {!! Form::model($skill, ['route' => ['skills.update', $skill->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
            <div class="form-group row">
                <label class="col-sm-3 control-label">Tên</label>
                <div class="col-sm-9 {!! $errors->has('name') ? 'has-error' : '' !!}">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block"><b>{!! $errors->first('name') !!}</b></span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <button class="btn btn-primary">Cập nhật</button>
                    <a href="{!! route('skills.index') !!}" class='btn btn-primary'>Trở về</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection