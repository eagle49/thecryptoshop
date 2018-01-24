@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Forgot
    @parent
    @stop

    {{-- page level styles --}}
    @section('header_styles')
            <!--start of page level css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/forgot.css') }}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <!--end of page level css-->
@stop

{{-- breadcrumb --}}
@section('top')
    <div class="breadcum">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Home
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    <a href="#">Register</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="question" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Forgot password
            </div>
        </div>
    </div>
    @stop


    {{-- Page content --}}
    @section('content')
    <div class="container forgot-container">
        <div class="row">
            <div class="box animation flipInX">
                <img src="{{ asset('assets/images/josh-new.png') }}" alt="logo" class="img-responsive mar">
                <h3 class="text-primary">Forgot Password</h3>
                <p>Enter your email to reset the password</p>
                @include('notifications')
                <form action="{{ route('forgot-password') }}" class="omb_loginForm" autocomplete="off" method="POST">
                    {!! Form::token() !!}
                    <div class="form-group">
                        <label class="sr-only"></label>
                        <input type="email" class="form-control email" name="email" placeholder="Email"
                               value="{!! old('email') !!}">
                        <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                    </div>
                    <div class="form-group">
                        <input class="form-control btn btn-primary btn-block" type="submit" value="Reset Your Password">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!--global js starts-->
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/forgotpwd_custom.js') }}"></script>
    <!--global js end-->
@stop
