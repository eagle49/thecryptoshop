@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Users List
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
<link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/pages/settings.css') }}" rel="stylesheet">

@stop

<?php
    //var_dump($users);
?>
{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Settings</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li class="active">General Settings</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="livicon" data-name="search" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Edit Settings
                </h3>
                <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                </span>
            </div>
            <div class="panel-body">
                <form method="POST" name="frmOnline" id='form_settings' enctype="multipart/form-data" action="{{ route('admin.settings.store') }}">
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="col-md-12 form-group">
                        <label for="txtCurrency" class="col-sm-2 control-label">Default Currency *</label>
                        <div class="col-sm-10">
                            <select name="selCurrency" id="selCurrency" class="form-control">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}" @if ($settings->currency == $currency->id) selected @endif >{{ $currency->description }}({{ $currency->unicode }})</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtMinOrder1" class="col-sm-2 control-label">Minium order1 *</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtMinOrder1" id="txtMinOrder1" class="form-control input-md" placeholder="Minium order of guest per day" value="{{ $settings->min_order1 }}">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtMaxOrder1" class="col-sm-2 control-label">Maxium order1 *</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtMaxOrder1" id="txtMaxOrder1" class="form-control input-md" data-role="currency" placeholder="Maxium order of guest per day" value="{{ $settings->max_order1 }}">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtMinOrder2" class="col-sm-2 control-label">Minium order2 *</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtMinOrder2" id="txtMinOrder2" class="form-control input-md" placeholder="Minium order of approved customer per day" value="{{ $settings->min_order2 }}">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtMaxOrder2" class="col-sm-2 control-label">Maxium order2 *</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtMaxOrder2" id="txtMaxOrder2" class="form-control input-md" data-role="currency" placeholder="Maxium order of approved customer per day" value="{{ $settings->max_order2 }}">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtPaymentInfo" class="col-sm-2 control-label">Payment information *</label>
                        <div class="col-sm-10">
                            <textarea name="txtPaymentInfo" id="txtPaymentInfo" class="form-control input-md" data-role="currency" rows="4" placeholder="Payment information">{{ $settings->payment_info }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="chkDisQuantity" class="col-sm-2 control-label">Display Quantity</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="chkDisQuantity" id="chkDisQuantity" class="form-control input-md input-chk" data-role="currency" @if($settings->display_quantity) checked @endif>
                            <label for="chkDisQuantity" class="control-label chk-label">Check this to display the quantity for the coins</label>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="chkDisFee" class="col-sm-2 control-label">Display Fee</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="chkDisFee" id="chkDisFee" class="form-control input-md input-chk" data-role="currency" @if($settings->display_fee) checked @endif>
                            <label for="chkDisFee" class="control-label chk-label">Check this to display the fee for the coins</label>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtNotificationEmail" class="col-sm-2 control-label">Order Notification Email *</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtNotificationEmail" id="txtNotificationEmail" class="form-control input-md" data-role="currency" placeholder="Order notification email" value="{{ $settings->notification_email }}">
                        </div>
                    </div>
                    <div class="col-md-12 mar-10">
                        <div class="col-xs-6 col-md-6">
                            <input type="submit" name="btnSubmit" id="btnSubmit" value="Update Settings" class="btn btn-primary btn-block btn-md btn-responsive">
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <input type="reset" value="Cancel" class="btn btn-success btn-block btn-md btn-responsive">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    <!-- row-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    {{--<script src="{{ asset('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js') }}"></script>--}}
    <script src="{{ asset('assets/js/pages/settings.js') }}"></script>
@stop
