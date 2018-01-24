<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use App\BlogComment;
use App\Http\Requests;
use App\Http\Requests\BlogCommentRequest;
use App\Http\Requests\BlogRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Response;
use Sentinel;
use App\Product;
use App\Settings;
use App\Orders;
use Mail;
use Illuminate\Http\Request;


class CoinsController extends JoshController
{


    private $tags;

    public function __construct()
    {
        parent::__construct();
        $this->tags = Blog::allTags();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index($coinId)
    {
        $user = Sentinel::getUser();
        
        $approved = Sentinel::approved()?true:false;
        $coin = Product::where('id', $coinId)->first();
        $setting = Settings::all()[0];
        return view('bitcoin',compact('coin', 'setting', 'approved'));
    }

    /**
     * save order to database
     */
    public function saveOrder(Request $request) {

        $tag = $request['tag'];
        $total = $request['total'];

        $product = Product::where('code', $tag)->first();
        $coin_id = $product['id'];
        $fee_type = $product['fee_type'];
        $fee = $product['fee'];

        $cal_price = $request['coin_price'] - $fee;   //£48

        if ( $fee_type == 2 ) {
            $cal_price = $request['coin_price'] - ($request['coin_price'] * $fee / 100);
        }

        $cal_coin = number_format($cal_price / $total, 4, ".", "");
        $fee_type = $fee_type == 1 ? '£' : '%';        

        $user = Sentinel::getUser();
        
        $order = new Orders();

        $order_id = $this->generateOrderId();
        $order->order_id = $order_id;
        $order->customer_id = $user!=null?$user->id:'9999';
        $order->session_id = 'SESSION';
        $order->wallet = $request['wallet'];
        $order->email = $request['email'];
        $order->fname = $request['fname'];
        $order->sname = $request['sname'];
        $order->coin_id = $coin_id;
        $order->coin_cost = $request['coin_price'];
        $order->coin_price = $request['crypto_price'];
        $order->order_date = date('Y-m-d h:i:s');
        $order->order_status = 1;

        $isOrderCreated = $order->save();
        
        $setting = Settings::all()[0];
        $admin_mail = $setting->notification_email;
        //Send email to admin
        $data = array('name'=> $request['fname'], 'tag'=>$tag, 'coin_cost'=>$request['coin_price'], 'coin_price'=>$request['crypto_price'], 'fee'=>$fee.$fee_type, 'cal_coin'=>$cal_coin, 'mail'=>$admin_mail, 'wallet'=>$request['wallet'], 'order_id'=>$order_id);
        Mail::send('mailtemplate.order', $data, function($message) use ($data) {
            $message->to($data['mail'], 'To Jacoub')->subject
            ('New order');
            $message->from('customer@gmail.com',$data['name']);
        });

        return $order_id.":".$admin_mail;
    }

    /**
     * generate unique order by date
     */

    public function generateOrderId() {
        $today = date("Ymd");
        $rand = strtoupper(substr(uniqid(sha1(time())),0,4));
        $orderId = 'PKC-' . $today . $rand;
        return $orderId;
    }
    /**
     * set status to expired
     */
    public function setExpire( Request $request ) {
        $order_id = $request['order_id'];
        $order = Orders::where('order_id', $order_id)->first();
        $order->order_status = 3;
        $order->save();
        return 'success Expired';
    }
    /**
     * bind if the order is approved by admin
     */
    public function orderStatus( Request $request ) {
        $order_id = $request['orderId'];
        $order = Orders::where('order_id', $order_id)->first();
        if( $order->order_status == 1 ) {
            return 'pending|';
        } else if ( $order->order_status == 2 ) {
            $setting = Settings::all()[0];
            $coin_id = $order->coin_id;
            $product = Product::where('id', $coin_id)->first();

            $fee_type = $product['fee_type'];
            $fee = $product['fee'];
            
            $result = 'accepted|';
            $result .= $order->coin_cost."|";
            $result .= $order->coin_price."|";
            $result .= $fee_type."|";
            $result .= $fee."|";
            $result .= $setting->payment_info;
            return $result;
        }
    }
}
