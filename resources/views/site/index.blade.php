@extends('layout.site.template')

@section('content')
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="{{asset('images/banners/bn1.jpg')}}" alt="Banner1">
        </div>
        <div class="item">
            <img src="{{asset('images/banners/bn2.jpg')}}" alt="Banner2">
        </div>
        <div class="item">
            <img src="{{asset('images/banners/bn3.jpg')}}" alt="Banner3">
        </div>
        <div class="item">
            <img src="{{asset('images/banners/bn4.jpg')}}" alt="Banner3">
        </div>
    </div>  

    <!-- Form search -->
    <form class="form-inline form-search col-md-8 col-md-offset-2 col-sm-12">
        <div class="center-block">
            <div class="input-group col-md-3">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                </div>
                <select class="form-control">
                    <option value="" disabled selected>Địa điểm</option>
                    @foreach($address as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach 
                </select>
            </div>
            <div class="input-group col-md-4">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                </div>
                <select class="form-control">
                    <option value="" disabled selected>Công nghệ</option>
                    @foreach($skills as $skill)
                        <option value="{{$skill->id}}">{{$skill->name}}</option>
                    @endforeach 
                </select>
            </div>
            <div class="input-group col-md-3">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
                </div>
                <select class="form-control">
                    <option value="" disabled selected>Cấp bậc</option>
                    @foreach($levels as $level)
                        <option value="{{$level->id}}">{{$level->name}}</option>
                    @endforeach 
                </select>
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-default"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Tìm kiếm</button>
            </div>
        </div>
    </form> 

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container">
    <div class="row" style="margin-top: 10px;">
        <div class="col-md-9">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Việc làm mới nhất</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Bảng xếp hạng Công nghệ</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Bảng xếp hạng Công ty</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
        </div>
    </div>
</div>
@endsection