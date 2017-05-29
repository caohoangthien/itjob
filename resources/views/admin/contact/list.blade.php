@extends('layout.management.template')

@section('title', 'Danh sách liên hệ')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th>Tên</th>
            <th>Email</th>
            <th>Nội dung</th>
            <th class="text-center">Thao tác</th>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ str_limit($contact->content, 40) }}</td>
                <td class="text-center">
                    <a href="{!! route('admins.contact.show', [$contact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admins.contact.delete', [$contact->id]) !!}" class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $contacts->links() }}
    </div>
@endsection