@extends('layout.site.template')

@section('content')
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
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
    </div>

    <!-- Form search -->
    <div class="container-fluid">
        <div class="row">
            <div class="form-search col-md-8 col-md-offset-2 col-xs-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                            </div>
                            <input id="search-name" type="text" class="form-control" placeholder="Tên công việc">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                            </div>
                            <input id="search-company" type="text" class="form-control" placeholder="Tên công ty">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                            </div>
                            <select id="search-address" class="form-control">
                                <option value="" disabled selected>Địa điểm</option>
                                @foreach($address as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading clearfix">
                    <p class="panel-title pull-left">Việc làm mới nhất</p>
                    <div class="btn-group pull-right">
                        <a class="btn btn-default">Xem thêm</a>
                    </div>
                </div>
                <div class="panel-body">
                    <p id="message-result"></p>
                    <div class="custom-scroll">
                        <div id="new-job">
                            <ul class="list-group">
                                @foreach($jobs as $job)
                                    <li class="list-group-item">
                                        <p class="job-title"><a>{{ str_limit($job->title, 70) }}</a></p>
                                        <p class="job-company"><a><b>{{ $job->company->name }}</b></a> - <a><b>{{ $job->address->name }}</b></a></p>
                                        <p class="job-salary">{{ $job->salary->salary }} | Ngày đăng: {{ date_format($job->created_at,"d/m/Y") }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div id="search-job">
                            <ul class="list-group">
                                <div id="job-result"></div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <select class="form-control">
                        <option value="" >Tháng 1</option>
                        <option value="" >Tháng 2</option>
                        <option value="" >Tháng 3</option>
                    </select>
                </div>
                <div class="panel-body">
                    <div id="chartContainer" style="height: 410px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript" src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/canvasjs.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/jquery.nicescroll.min.js') !!}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}
        });

        var search = {
            title: '',
            address_id: '',
            company: ''
        };

        $('#search-name').on('keyup', function(){
            $('#new-job').hide();
            $('#job-result').empty();
            search.title = $(this).val();
            $.ajax({
                url : "{{route('jobs.search-ajax')}}",
                type : "post",
                dataType:"json",
                data : search,
                success : function (result){
                    if (result.length == 0) {
                        $('#message-result').text('Không tìm thấy công việc phù hợp.');
                    } else {
                        $('#message-result').text('Tìm thấy ' + result.length + ' công việc phù hợp.');
                        var html = '';
                        $.each( result, function( key, value ) {
                            html += '<li class="list-group-item">';
                            html += '<p class="job-title"><a>' + value.title + '</a></p>';
                            html += '<p class="job-company"><a><b>' + value.company.name + '</b></a> - <a><b>' + value.address.name + '</b></a></p>';
                            html += '<p class="job-salary">' + value.salary.salary + ' | Ngày đăng: ' + value.created_at + '</p>';
                            html += '</li>';
                        });
                        $('#job-result').html(html);
                    }
                }
            });
        });

        $('#search-company').on('keyup', function(){
            $('#new-job').hide();
            $('#job-result').empty();
            search.company = $(this).val();
            $.ajax({
                url : "{{route('jobs.search-ajax')}}",
                type : "post",
                dataType:"json",
                data : search,
                success : function (result){
                    if (result.length == 0) {
                        $('#message-result').text('Không tìm thấy công việc phù hợp.')
                    } else {
                        $('#message-result').text('Tìm thấy ' + result.length + ' công việc phù hợp.');
                        var html = '';
                        $.each( result, function( key, value ) {
                            html += '<li class="list-group-item">';
                            html += '<p class="job-title"><a>' + value.title + '</a></p>';
                            html += '<p class="job-company"><a><b>' + value.company.name + '</b></a> - <a><b>' + value.address.name + '</b></a></p>';
                            html += '<p class="job-salary">' + value.salary.salary + ' | Ngày đăng: ' + value.created_at + '</p>';
                            html += '</li>';
                        });
                        $('#job-result').html(html);
                    }
                }
            });
        });

        $("#search-address").change(function() {
            $('#new-job').hide();
            $('#job-result').empty();
            search.address_id = $(this).val();
            $.ajax({
                url : "{{route('jobs.search-ajax')}}",
                type : "post",
                dataType:"json",
                data : search,
                success : function (result){
                    if (result.length == 0) {
                        $('#message-result').text('Không tìm thấy công việc phù hợp.')
                    } else {
                        $('#message-result').text('Tìm thấy ' + result.length + ' công việc phù hợp.');
                        var html = '';
                        $.each( result, function( key, value ) {
                            html += '<li class="list-group-item">';
                            html += '<p class="job-title"><a>' + value.title + '</a></p>';
                            html += '<p class="job-company"><a><b>' + value.company.name + '</b></a> - <a><b>' + value.address.name + '</b></a></p>';
                            html += '<p class="job-salary">' + value.salary.salary + ' | Ngày đăng: ' + value.created_at + '</p>';
                            html += '</li>';
                        });
                        $('#job-result').html(html);
                    }
                }
            });
        });

        var chart = new CanvasJS.Chart("chartContainer",
            {
                animationEnabled: true,
                legend: {
                    verticalAlign: "bottom",
                    horizontalAlign: "center"
                },
                theme: "theme2",
                data: [
                    {
                        type: "column",
                        showInLegend: true,
                        legendMarkerColor: "grey",
                        dataPoints: [
                            {y: 20, label: "PHP"},
                            {y: 50,  label: "Java" },
                            {y: 10,  label: "NodeJs"},
                            {y: 15,  label: "C#"},
                            {y: 2,  label: "Ruby"},
                        ]
                    }
                ]
            });

        chart.render();
    });
</script>
@endsection