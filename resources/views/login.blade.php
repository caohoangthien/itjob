@extends('layouts.login')

@section('content')
    <div class="container">
            <div class="row">
                <form action="{{url('/login')}}" method="post" class="col-md-4 col-md-offset-4 form-login">
                    <img src="{{asset('images/icons/signin.png')}}" width="100" class="img-responsive" />
                    {!! csrf_field() !!}
                    @if (count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li><p class="text-danger">{{ $error }}</p></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                        <p class="text-success">{{ session('success') }}</p>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Email</label>    
                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
                </form>
            </div>           
        </div>
@endsection