@extends('layout.management.template')

@section('title', 'Thông tin liên hệ')

@section('content')
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Tên</label>
            <p>{{$contact->name}}</p>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <p>{{$contact->email}}</p>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nội dung</label>
            <p>{{$contact->content}}</p>
        </div>
        <a href="{!! route('admins.contact.list') !!}" class="btn btn-primary">Trở về</a>
    </form>
@endsection