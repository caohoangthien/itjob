@extends('layout.management.template')

@section('title', 'Danh sách công việc')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    <table class="table table-bordered table-hover table-striped">
        <thead>
        <th class="text-center">Id</th>
        <th>Tiêu đề</th>
        <th>Địa chỉ</th>
        <th>Mức lương</th>
        <th class="text-center">Số lượng</th>
        <th class="text-center">Ngày đăng</th>
        <th>Thao tác</th>
        </thead>
        <tbody>
        @foreach($jobs as $job)
            <tr>
                <td class="text-center">{!! $job->id !!}</td>
                <td>{{ $job->title }}</td>
                <td>{{ $job->address->name }}</td>
                <td>{{ $job->salary->salary }}</td>
                <td class="text-center">{{ $job->quantity }}</td>
                <td class="text-center">{{ date_format($job->created_at,"d-m-Y") }}</td>
                <td>
                    <a href="{!! route('admins.job.show', [$job->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admins.job.delete', [$job->id]) !!}" class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i></a>
                    <a class='btn btn-primary btn-xs btn-active-job' data-url="{!! route('admins.job.ajax-update-status', $job->id) !!}">{{ $job->status == 1 ? 'Active' : 'Deactive' }}</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $jobs->links() }}
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="{!! asset('js/js-admin-update-job.js') !!}"></script>
@endsection