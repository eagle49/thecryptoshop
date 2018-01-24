@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Users List
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/pages/product.css') }}" rel="stylesheet" type="text/css" />
@stop

<?php
    //var_dump($users);
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
        <li><a href="#"> Coins</a></li>
        <li class="active">Coins List</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box primary">
            <div class="portlet-title">
                <div class="caption">
                    <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Coins List
                </div>
            </div>
            <div class="portlet-body flip-scroll">
                <table class="table table-bordered table-striped table-condensed flip-content" >
                    <thead class="flip-content">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Logo</th>
                            <th>Quantity</th>
                            <th>Allow order</th>
                            <th>Code</th>
                            <th>URL1</th>
                            <th>URL2</th>
                            <th>URL3</th>
                            <th><i class="livicon" data-name="twitter" data-size="20" data-c="#00F" data-hc="#00F" data-loop="true">Twitter</i></th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}  </td>
                            <td>{{ $product->title }}  </td>
                            <td>{{ $product->description }}  </td>
                            <td class="prod-logo"><img src="{{ asset('uploads/products/') }}/{{ $product->pic_product }}" alt="Logo"></td>
                            <td>{{ $product->quantity }}  </td>
                            <td>@if($product->allow_order) <i class="livicon" data-name="check-circle" data-size="20" data-c="#0F0" data-hc="#0F0" data-loop="true"></i> @else <i class="livicon" data-name="ban" data-size="20" data-c="#F00" data-hc="#F00" data-loop="true"></i> @endif</td>
                            <td>{{ $product->code }}  </td>
                            <td>{{ $product->url1 }}  </td>
                            <td>{{ $product->url2 }}  </td>
                            <td>{{ $product->url3 }}  </td>
                            <td>{{ $product->twitter }}  </td>
                            <td><a href="{{ route('admin.products.edit', $product->id) }}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><a class="delete-product" href="{{ route('confirm-delete/product', $product->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>    <!-- row-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}" ></script>
    <script src="{{ asset('assets/js/pages/table-responsive.js') }}"></script>

<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="product_delete_confirm_title" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content"></div>
  </div>
</div>
<script>
$(function () {
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});
});
</script>
@stop
