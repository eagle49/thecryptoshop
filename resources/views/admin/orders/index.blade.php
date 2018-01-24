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
<link href="{{ asset('assets/css/pages/orders.css') }}" rel="stylesheet" type="text/css" />
@stop

<?php
    //var_dump($users);
?>
{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Orders</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="#"> Orders</a></li>
        <li class="active">Orders List</li>
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
                    Orders List
                </div>
            </div>
            <div class="portlet-body flip-scroll">
                <table class="table table-bordered table-striped table-condensed flip-content" >
                    <thead class="flip-content">
                        <tr>
                            <th>Order Id</th>
                            <!-- <th>Customer Id</th> -->
                            <th>Wallet Address</th>
                            <th>Email</th>
                            <th>Coin Type</th>
                            <th>Coin Price</th>
                            <th>Coin Quantity</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Complete Date</th>
                            <th>Accept</th>
                            <th>Complete</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <!-- <td>{{ $order->customer_id }}</td> -->
                            <td>{{ $order->wallet }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->coin_code }}</td>
                            <td>{{ $order->coin_cost }}</td>
                            <td>{{ $order->coin_price }}</td>
                            <td>{{ $order->order_date }}</td>
                            <!-- <td>@if ( $order->order_status == 1 ) Pending @else Complete @endif </td> -->
                            <td>{{ $order->orderstatus }}</td>
                            <td>{{ $order->complete_date }}</td>
                            <td class='center-align'>@if ( $order->order_status == 1 ) <a class="accept-order" href="{{ route('confirm-accept/order', $order->order_id) }}" data-toggle="modal" data-target="#order_confirm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> @elseif ( $order->order_status == 2 || $order->order_status == 4 ) <i class="fa fa-check" aria-hidden="true"></i> @endif</td>
                            <td class='center-align'>@if ( $order->order_status == 2 ) <a class="accept-order" href="{{ route('confirm-complete/order', $order->order_id) }}" data-toggle="modal" data-target="#order_confirm"><i class="fa fa-flag" aria-hidden="true"></i></a> @elseif ( $order->order_status == 4 ) <i class="fa fa-check" aria-hidden="true"></i> @endif</td>
                        </tr>
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
    <script src="{{ asset('assets/js/pages/orders.js') }}"></script>

<div class="modal fade" id="order_confirm" tabindex="-1" role="dialog" aria-labelledby="product_delete_confirm_title" aria-hidden="true">
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
