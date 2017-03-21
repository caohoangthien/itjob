@extends('layouts.login')

@section('content')
        <div class="container">
            <div class="row">
                <form action="{{url('/signup-company')}}" method="post" class="col-md-4 col-md-offset-4 form-login">
                    {!! csrf_field() !!}
                    <img src="{{asset('images/icons/company.png')}}" class="img-responsive" style="margin: 15px auto" />
                    @if (count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li><p class="text-danger">{{ $error }}</p></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('errorSystem'))
                    <div class="alert alert-success">
                        <p class="text-success">{{ session('errorSystem') }}</p>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Sign up</button>
                </form>
            </div>           
        </div>
@endsection