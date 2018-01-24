<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use Illuminate\Http\Request;
use Lang;
use Mail;
use Redirect;
use Sentinel;
use URL;
use View;
use Datatables;
use Validator;

use App\Orders;

class OrdersController extends JoshController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::All();
        for( $i = 0; $i < count($orders); $i++) {
            $order = $orders[$i];
            $order_date = $order->order_date;
            $today = date('Y-m-d h:i:s');
            $diff = strtotime($today) - strtotime($order_date);
            if ( $diff > 30*60 && $order->order_status == 1 ){
                $order->order_status = 3;
                $order->save();
            }
        }
        // Grab all the orders
        $orders = Orders::leftJoin('order_status', function($join) {
            $join->on('orders.order_status', '=', 'order_status.id');
        })
        ->leftJoin('products', function($join) {
            $join->on('orders.coin_id', '=', 'products.id');
        })
        ->orderby('order_id', 'DESC')->get(['orders.*', 'order_status.orderstatus as orderstatus', 'products.code as coin_code']);

        // Show the page
        return view('admin.orders.index', compact('orders'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    /**
     * Accept the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        //
         // Delete the Coin
        //to allow soft deleted, we are performing query on users model instead of Sentinel model
        $order = Orders::where('order_id', $id)->first();
        $order->order_status = 2;

        $order->save();

        // Prepare the success message
        $success = Lang::get('orders/message.success.accepted');

        // Redirect to the product management page
        return Redirect::route('admin.orders.index')->with('success', $success);
    }

    /**
     * Complete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complete($id)
    {
        //
         // Delete the Coin
        //to allow soft deleted, we are performing query on users model instead of Sentinel model
        $order = Orders::where('order_id', $id)->first();
        $order->order_status = 4;
        $order->complete_date = date('Y-m-d h:i:s');

        $order->save();

        // Prepare the success message
        $success = Lang::get('orders/message.success.completed');

        // Redirect to the product management page
        return Redirect::route('admin.orders.index')->with('success', $success);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * accept Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalAccpet($id = null)
    {
        $model = 'orders';
        $confirm_route = $error = null;
        $confirm_route = route('accept/order', ['id' => $id]);
        return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    public function getModalComplete($id = null)
    {
        $model = 'orders';
        $confirm_route = $error = null;
        $confirm_route = route('complete/order', ['id' => $id]);
        return view('admin.layouts.modal_confirmation_complete', compact('error', 'model', 'confirm_route'));
    }

}
