@extends('layout.management.template')

@section('title', 'Tin đã đăng')

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
        <th class="text-center">Thao tác</th>
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
                <td class="text-center">
                    <a href="{!! route('jobs.show', [$job->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('jobs.edit', [$job->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {{ Form::open(['route' => ['jobs.destroy', $job->id], 'method' => 'DELETE', 'class' => 'form-delete']) }}
                    <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $jobs->links() }}
    </div>
@endsection