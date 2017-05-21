@extends('layout.site.template')

@section('css')
    <style>
        .ui-datepicker-calendar {
        display: none;
        }​
    </style>
@endsection

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
                            <input id="search-name" type="text" class="form-control" data-url="{!! route('jobs.search-ajax') !!}" placeholder="Tên công việc">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                            </div>
                            <input id="search-company" type="text" class="form-control" data-url="{!! route('jobs.search-ajax') !!}" placeholder="Tên công ty">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                            </div>
                            <select id="search-address" class="form-control" data-url="{!! route('jobs.search-ajax') !!}">
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
                        <a href="{!! route('jobs.full') !!}" class="btn btn-default">Xem thêm</a>
                    </div>
                </div>
                <div class="panel-body">
                    <p id="message-result"></p>
                    <div class="custom-scroll">
                        <div id="new-job">
                            <ul class="list-group">
                                @foreach($jobs as $job)
                                    <li class="list-group-item">
                                        <p class="job-title"><a href="{!! route('jobs.search-title', $job->id) !!}">{{ str_limit($job->title, 70) }}</a></p>
                                        <p class="job-company"><a href="{!! route('company.infor', $job->company_id) !!}"><b>{{ $job->company->name }}</b></a> - <b>{{ $job->address->name }}</b></p>
                                        <p class="job-salary">{{ $job->salary->salary }} | Ngày đăng: {{ $job->created_at->format('d/m/Y') }} | Hạn cuối: {{ $job->deadline->format('d/m/Y') }}</p>
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
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
                                <input type="text" class="form-control" id="datepicker-frontend" data-url="{!! route('getChart') !!}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="chartContainer" style="height: 325px; width: 100%;"></div>
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
                                    {!! Form::checkbox('salaries_id[]', $salary->id) !!} {!! $salary->salary !!}
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

@section('javascript')
<script type="text/javascript" src="{!! asset('js/canvasjs.min.js') !!}"></script>
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
            var url =  $(this).data('url');
            $.ajax({
                url : url,
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
            var url =  $(this).data('url');
            $.ajax({
                url : url,
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
            var url =  $(this).data('url');
            $.ajax({
                url : url,
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
                theme: "theme2",
                title:{
                    text: "Thống kê tuyển dụng theo tháng"
                },
                data: [
                    {
                        type: "column", //change type to bar, line, area, pie, etc
                        dataPoints: <?php echo json_encode($chart, JSON_NUMERIC_CHECK); ?>
                    }
                ]
            });

        chart.render();

        $("#datepicker-frontend").datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'm-yy',
            onClose: function(dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                var yearMonth = $(this).val();
                var url = $(this).data('url');
                $.ajax({
                    url : url,
                    type : "post",
                    dataType:"json",
                    data : {
                        yearMonth : yearMonth
                    },
                    success : function (data){
                        var chart = new CanvasJS.Chart("chartContainer",
                            {
                                animationEnabled: true,
                                theme: "theme2",
                                title:{
                                    text: "Thống kê tuyển dụng theo tháng"
                                },
                                data: [
                                    {
                                        type: "column", //change type to bar, line, area, pie, etc
                                        dataPoints: data
                                    }
                                ]
                            });

                        chart.render();
                    }
                });
            }
        });
    });
</script>
@endsection