@extends('layout.master')

@section('title', 'Homely | Register')
@section('keywords', 'Homely,buy home,rent home')
@section('description', 'Homely description will update soon')
@section('image', '/images/logo.png')

@section('container')
<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <h3 class="text-center">
        Register / <a href="{{ url('/user/login') }}">Login</a>
        </h3> 
        <div class="seperate"></div>
        <div class="panel panel-default">
        <div class="panel-body">
        <form method="post" action='/user/register'>
            {{ csrf_field() }}
            @if ($errors->all())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="first_name">First name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name')}}" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone number:</label>
                <input type="text" class="form-control ltr" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="09123456789">
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" class="form-control ltr" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control ltr" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-block homely-btn homely-red">Register</button>
        </form>
        </div>  
        </div>
    </div>
</div>
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
@endsection