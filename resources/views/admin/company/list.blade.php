@extends('layout.management.template')

@section('title', 'Danh sách công ty')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th class="text-center">Id</th>
            <th>Tên công ty</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Giới thiệu</th>
            <th class="text-center">Thao tác</th>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <td class="text-center">{!! $company->id !!}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->account->email }}</td>
                <td>{{ $company->address->name }}</td>
                <td>{{ $company->phone }}</td>
                <td>{{ str_limit($company->about, 30) }}</td>
                <td class="text-center">
                    <a href="{!! route('admins.company.show', [$company->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admins.company.delete', [$company->id]) !!}" class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $companies->links() }}
    </div>
@endsection