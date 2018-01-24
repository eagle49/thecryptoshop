<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\User;
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
use App\Currency;
use App\Settings;

class SettingsController extends JoshController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $currencies = Currency::all();
        $settings = Settings::all()[0];
        return view('admin.settings.index', compact('currencies','settings'));
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
        //Save product
        $setting = Settings::all()[0];
        $setting -> currency    = $request->get('selCurrency');
        $setting -> min_order1  = $request->get('txtMinOrder1');
        $setting -> max_order1  = $request->get('txtMaxOrder1');
        $setting -> min_order2  = $request->get('txtMinOrder2');
        $setting -> max_order2  = $request->get('txtMaxOrder2');
        $setting -> payment_info = $request->get('txtPaymentInfo');
        $setting -> display_quantity = $request->get('chkDisQuantity')=="on"?1:0;
        $setting -> display_fee = $request->get('chkDisFee')=="on"?1:0;
        $setting -> notification_email  = $request->get('txtNotificationEmail');
        
        $setting->save();

        //Return to product list
        return Redirect::route('admin.settings.index')->with('success', Lang::get('settings/message.success.create'));
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
}
