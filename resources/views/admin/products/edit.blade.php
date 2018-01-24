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
<link href="{{ asset('assets/css/pages/product.css') }}" rel="stylesheet">


@stop

<?php
    //var_dump($product);
?>
{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Coins</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.products.index')}} "> Coins</a></li>
        <li class="active">Edit Coin</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="livicon" data-name="search" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Edit Coin
                </h3>
                <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                </span>
            </div>
            <div class="panel-body">
                <form method="POST" name="frmOnline" id='form_product' enctype="multipart/form-data" action="{{ route('admin.products.update', $product->id) }}">
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="col-md-12 form-group">
                        <label for="txtTitle" class="col-sm-2 control-label">Coin Title *</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtTitle" id="txtTitle" class="form-control input-md" placeholder="Coin Title" value="{{ $product->title }}">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtDescription" class="col-sm-2 control-label">Coin Description *</label>
                        <div class="col-sm-10">
                            <textarea rows="5" name="txtDescription" id="txtDescription" class="form-control input-md" placeholder="Coin Description" value="{{ $product->description }}"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtQuantity" class="col-sm-2 control-label">Coin Quantity *</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtQuantity" id="txtQuantity" class="form-control input-md" data-role="currency" placeholder="Coin Quantity"  value="{{ $product->quantity }}">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="allow_order" class="col-sm-2 control-label"> Allow Order</label>
                        <div class="col-sm-10">
                            <input id="allow_order" name="allow_order" type="checkbox"
                                   class="pos-rel p-l-30 custom-checkbox"
                                   value="1" @if($product->allow_order) checked="checked" @endif>
                            <span>To allow the customers to allow this coin click the check box.</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->first('pic_product', 'has-error') }}">
                        <label for="pic_product" class="col-sm-2 control-label">Coin Logo *</label>
                        <div class="col-sm-10">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                    @if($product->pic_product)
                                        <img src="{!! url('/').'/uploads/products/'.$product->pic_product !!}" alt="profile pic_product">
                                    @else
                                        <img src="http://placehold.it/200x200" alt="profile pic_product">
                                    @endif
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                    <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input id="pic_product" name="pic_product" type="file" class="form-control" />
                                    </span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput" style="color: black !important;">Remove</a>
                                    </div>
                                </div>
                        </div>
                        {!! $errors->first('bio', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtCode" class="col-sm-2 control-label">Coin Code *</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtCode" id="txtCode" class="form-control input-md" placeholder="Coin Code" value="{{ $product->code }}">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="selFee" class="col-sm-2 control-label">Coin Fee *</label>
                        <div class="col-sm-10">
                            <select name="selFee" id="selFee" class="form-control" style="margin-bottom: 10px;">
                                <option value="1" @if ($product->fee_type == 1) selected @endif>Fixed Price</option>
                                <option value="2" @if ($product->fee_type == 2) selected @endif>% Price</option>
                            </select>
                            <input type="text" name="txtFee" id="txtFee" class="form-control input-md" placeholder="Coin Fee" value="{{ $product->fee }}">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtUrl1" class="col-sm-2 control-label">Coin URL1 </label>
                        <div class="col-sm-10">
                            <input type="text" name="txtUrl1" id="txtUrl1" class="form-control input-md" placeholder="Coin URL1" value="{{ $product->url1 }}">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtUrl2" class="col-sm-2 control-label">Coin URL2</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtUrl2" id="txtUrl2" class="form-control input-md" placeholder="Coin URL2" value="{{ $product->url2 }}">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtUrl3" class="col-sm-2 control-label">Coin URL3</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtUrl3" id="txtUrl3" class="form-control input-md" placeholder="Coin URL3" value="{{ $product->url3 }}">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="txtTwitter" class="col-sm-2 control-label">Coin URL3</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtTwitter" id="txtTwitter" class="form-control input-md" placeholder="Twitter Handler" value="{{ $product->twitter }}">
                        </div>
                    </div>
                    <div class="col-md-12 mar-10">
                        <div class="col-xs-6 col-md-6">
                            <input type="submit" name="btnSubmit" id="btnSubmit" value="Update" class="btn btn-primary btn-block btn-md btn-responsive">
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-success btn-block btn-md btn-responsive">Cancel</a>
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
    <script src="{{ asset('assets/js/pages/editproduct.js') }}"></script>
@stop
