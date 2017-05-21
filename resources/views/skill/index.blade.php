@extends('layout.management.template')

@section('title', 'Danh sách kỹ năng')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    <table class="table table-bordered table-hover table-striped">
        <thead>
        <th class="text-center">Id</th>
        <th>Kỹ năng</th>
        <th class="text-center">Thao tác</th>
        </thead>
        <tbody>
        @foreach($skills as $skill)
            <tr>
                <td class="text-center">{!! $skill->id !!}</td>
                <td>{{ $skill->name }}</td>
                <td class="text-center">
                    <a href="{!! route('skills.edit', [$skill->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {{ Form::open(['route' => ['skills.destroy', $skill->id], 'method' => 'DELETE', 'class' => 'form-delete']) }}
                    <button class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $skills->links() }}
    </div>
@endsection