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

use App\Product;

class ProductsController extends JoshController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Grab all the products
        $products = Product::All();

        //var_dump($products);

        // Show the page
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.products.create');
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
        $rules = array(
            'pic_product' => 'image|mimes:svg,jpg,jpeg,bmp,png',
        );

        $validator = Validator::make($request->only('pic_product'), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                 ->with('error',Lang::get('products/message.error.file_type_error'))
                ->withInput();
        }

        //upload image
        if ($file = $request->file('pic_product')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/products/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $request['pic'] = $safeName;
        }

        //Save product
        $product = new Product();
        $product -> title       = $request->get('txtTitle');
        $product -> description = $request->get('txtDescription');
        $product -> quantity    = $request->get('txtQuantity');
        $product -> allow_order = $request->get('allow_order');
        $product -> pic_product = $request->get('pic');
        $product -> code        = $request->get('txtCode');
        $product -> fee_type    = $request->get('selFee');
        $product -> fee         = $request->get('txtFee');
        $product -> url1        = $request->get('txtUrl1');
        $product -> url2        = $request->get('txtUrl2');
        $product -> url3        = $request->get('txtUrl3');
        $product -> twitter     = $request->get('txtTwitter');
        $product->save();

        //Return to product list
        return Redirect::route('admin.products.index')->with('success', Lang::get('products/message.success.create'));
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
        echo 'bbbbb';
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
        $product = Product::where('id', $id)->first();
        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        
        $rules = array(
            'pic_product' => 'image|mimes:svg,jpg,jpeg,bmp,png',
        );

        $validator = Validator::make($request->only('pic_product'), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                 ->with('error',Lang::get('products/message.error.file_type_error'))
                ->withInput();
        }

        //Save product
        $product = Product::find($id);

        //upload image
        if ($file = $request->file('pic_product')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/products/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $request['pic_product'] = $safeName;
            echo $safeName;
        } else {
            $request['pic_product'] = $product -> pic_product;
        }


        

        $product -> title       = $request->get('txtTitle');
        $product -> description = $request->get('txtDescription');
        $product -> quantity    = $request->get('txtQuantity');
        $product -> allow_order = $request->get('allow_order');
        $product -> pic_product = $request->get('pic_product');
        $product -> code        = $request->get('txtCode');
        $product -> fee_type    = $request->get('selFee');
        $product -> fee         = $request->get('txtFee');
        $product -> url1        = $request->get('txtUrl1');
        $product -> url2        = $request->get('txtUrl2');
        $product -> url3        = $request->get('txtUrl3');
        $product -> twitter     = $request->get('txtTwitter');

        $product->save();

        //Return to product list
        return Redirect::route('admin.products.index')->with('success', Lang::get('products/message.success.create'));
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
         // Delete the Coin
        //to allow soft deleted, we are performing query on users model instead of Sentinel model
        //$products->delete();
        Product::destroy($id);

        // Prepare the success message
        $success = Lang::get('products/message.success.delete');

        // Redirect to the product management page
        return Redirect::route('admin.products.index')->with('success', $success);
    }

    /**
     * Delete Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalDelete($id = null)
    {
        $model = 'products';
        $confirm_route = $error = null;
        $confirm_route = route('delete/product', ['id' => $id]);
        return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
    }
}
