@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    <h4>USER REGISTRATION FORM</h4>
                    <h6>register here to become a member of our website</h6>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <div class="text offset-4">
                            {{ session('success')}}
                        </div> 
                    </div>
                @endif

                @if($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif

                <div class="card-body">
                    {{-- <form method="POST" action="{{ route('register') }}"> --}}
                    <form method="POST" action="{{ url('user/register') }}">
                        @csrf
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" class="form-control" placeholder="Enter your username" name="username" value="{{ old('username')}}">
                        </div>
                        
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Enter password" name="password" value="{{ old('password')}}">
                        </div>

                        <div class="form-group">
                            <label>Email ID</label>
                            <input type="text" class="form-control" placeholder="Enter your email" name="email" value="{{ old('email')}}">
                        </div>

                        <div class="form-group">
                            <label>BirthDay</label>
                            <input type="date" class="form-control" name="birthdate" value="{{ old('birthdate')}}">
                        </div>
                        
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" placeholder="Enter your country" name="city" value="{{ old('city')}}">
                        </div>
                        
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" placeholder="Enter your country" name="country" value="{{ old('country')}}">
                        </div>
                       
                        <div class="form-group col-10">
                            <h4>Term and Conditions</h4>
                            <h6>Agreed amd Consent to our <span class="text-danger">terms of Service</span> and End User License agreement</h6>
                        </div>
                       
                        <div class="form-group col-10 offset-4">
                            <button  type="submit" class="btn btn-primary">Create New Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
