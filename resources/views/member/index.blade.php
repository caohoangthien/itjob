@extends('layout.management.template')

@section('title', 'Danh sách công việc phù hợp')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
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
                    <a href="{!! route('jobs.show', [$job->id]) !!}" class='btn btn-default btn-default'>Xem</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $jobs->links() }}
    </div>
@endsection