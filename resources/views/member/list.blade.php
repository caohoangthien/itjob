@extends('layout.management.template')

@section('title', 'Danh sách thành viên')

@section('content')
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th class="text-center">Id</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th class="text-center">Thao tác</th>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <td class="text-center">{!! $member->id !!}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->account->email }}</td>
                <td>{{ $member->address->name }}</td>
                <td>{{ $member->phone }}</td>
                <td class="text-center">
                    <a href="{!! route('members.show', [$member->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('members.destroy', [$member->id]) !!}" class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $members->links() }}
    </div>
@endsection