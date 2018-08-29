@extends('layout.master')

@section('title', 'Homely | Login')
@section('keywords', 'Homely,buy home,rent home')
@section('description', 'Homely description will update soon')
@section('image', '/images/logo.png')

@section('container')
<div class="row">
    <div class="col-xs-12">
        <h3 class="text-center">
            <a href="{{ url('/user/register') }}"> Register </a> / Login
        </h3> 
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="post" action="{{ url('/user/login') }}">
                    {{ csrf_field() }}
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <div class="alert alert-{{ $msg }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <ul class="list-unstyled">
                                    <li>{{ Session::get('alert-' . $msg) }}</li>
                                </ul>
                            </div>
                        @endif
                    @endforeach
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
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control ltr" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="text" class="form-control ltr" id="pwd" name="password" required>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="always" name="always" value="1">
                        <label for="always">Remember me!</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <hr>
                <div class="half-seperate">  </div>
                <a href='/user/register' class="text-center">Register</a>
                <div class="half-seperate"></div>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#sms-modal">
                Forget Password?
                </a>
            </div>
        </div>
    </div>
</div>
<div class="double-seperate"></div>
<div class="double-seperate"></div>
<div class="modal fade" id="sms-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Forget Password</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('/user/forget-password') }}" method="post">
                    {{ csrf_field() }}
                    <p class="bold">
                        Phone:
                    </p>
                    <input type="text" name="phone" class="form-control">
                    <div class="half-seperate"></div>
                    <button class="btn btn-success btn-block">Send New Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection