@extends('layout.management.template')

@section('title', 'Danh sách công việc')

@section('content')
    <table class="table table-bordered table-hover table-striped">
        <thead>
        <th class="text-center">Id</th>
        <th>Tiêu đề</th>
        <th>Địa chỉ</th>
        <th>Mức lương</th>
        <th>Số lượng</th>
        <th>Trạng thái</th>
        <th>Duyệt</th>
        <th>Ngày tạo</th>
        <th class="text-center">Thao tác</th>
        </thead>
        <tbody>
        @foreach($jobs as $job)
            <tr>
                <td class="text-center">{!! $job->id !!}</td>
                <td>{{ $job->title }}</td>
                <td>{{ $job->address->name }}</td>
                <td>{{ $job->salary->salary }}</td>
                <td>{{ $job->quantity }}</td>
                <td>{{ $job->status }}</td>
                <td><button class="btn btn-default">{{ $job->check == 0 ? 'Chưa duyệt' : 'Đã duyệt'}}</button></td>
                <td>{{ $job->created_at }}</td>
                <td class="text-center">
                    <a href="{!! route('admins.jobs.show', [$job->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
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