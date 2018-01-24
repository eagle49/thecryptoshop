@extends('layouts/default')

{{-- Page title --}}
@section('title')
About us
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/coins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/flipclock.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/timer.css') }}">
    <link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl.carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl.carousel/css/owl.theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/devicon/devicon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/devicon/devicon-colors.css') }}">
    <meta name="_token" content="{{ csrf_token() }}">
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
                    <a href="#">Coins</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="users" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Coins
            </div>
        </div>
    </div>
@stop


{{-- Page content --}}
@section('content')
    <!-- Container Start -->
    <div class="container">

        <!-- Service Section Start-->
        <div class="container order-slide buy-slide buy-slide-visible bx-wrapper">
            <div class="row" id="row1">
                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 sm-hide buy-info">
                    <center>
                        <img width="225px" src="{{ asset('uploads/products/') }}/{{ $coin->pic_product }}"> 
                        <h3 class="buy-coin-name">{{ $coin->title }}</h3>
                        <div class="buy-step">{{ $coin->title }} via bank transfer <span class="logo-blue">Step 1/3</span></div>
                        <p class="faq-text">Use the simple form on the right to get yourself a live quote and start the order process.  All we require is your Bitcoin wallet address, order amount and email.  You will then be taken to a confirmation page where you can verify your order.</p>
                    </center>
                    <br>
                    <ul class="nav nav-tabs" style="padding-top:4px;">
                        <li class="active"><a data-toggle="one"><i class="icon-briefcase"></i> Details</a></li>
                        <li class=""><a data-toggle="two">Important Links</a></li>
                        <li class=""><a data-toggle="three">Wallets</a></li>
                        <li class=""><a data-toggle="four">Faucets</a></li>
                        <!--<li><a data-toggle="five">Video</a></li>-->
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="one" style="text-align:left; padding-top:10px;">
                            <strong>Bitcoin</strong> is well known as being the world's first truly decentralized digital currency. It was first implemented in early 2009, and has become by far the most widespread cryptocurrency since then.  It boasts having the largest market cap and volume for any cryptocurrency available today.</div>
                            <div class="tab-pane" id="two">
                                    <a href="http://www.bitcoin.org/" target="_blank" class="btn btn-info" style="margin-top:15px;"><i class="fa fa-cog"></i> Official website</a><div style="height:11px;"></div>
                                    <a href="http://www.bitcointalk.org" target="_blank" class="btn btn-info" style="margin-top:5px;"><i class="fa fa-cog"></i> BitcoinTalk forums</a><div style="height:11px;"></div>
                                    <a href="https://bitcoinfoundation.org/" target="_blank" class="btn btn-info" style="margin-top:5px;"><i class="fa fa-cog"></i> The Bitcoin Foundation</a><div style="height:11px;"></div>                          </div>
                            <div class="tab-pane" id="three">
                                    <a href="http://www.blockchain.info" target="_blank" class="btn btn-success" style="margin-top:15px;"><i class="fa fa-cog"></i> Web wallet</a><div style="height:11px;"></div>
                                    <a href="https://bitcoin.org/en/choose-your-wallet" target="_blank" class="btn btn-success" style="margin-top:5px;"><i class="fa fa-cog"></i> Desktop wallet</a><div style="height:11px;"></div>
                                    <a href="https://www.bitcointrezor.com/" target="_blank" class="btn btn-success" style="margin-top:5px;"><i class="fa fa-cog"></i> Hardware wallet</a><div style="height:11px;"></div>                          
                        </div>
                    <div class="tab-pane" id="four">
                        <a href="http://bitcoinker.com/" target="_blank" class="btn btn-primary" style="margin-top:15px;"><i class="fa fa-cog"></i> Bitcoinker</a><div style="height:11px;"></div>
                        <a href="http://moonbit.co.in/" target="_blank" class="btn btn-primary" style="margin-top: 5px"><i class="fa fa-cog"></i> Moon Bitcoin</a>
                    </div>
                </div>                      
            </div>
            
                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12" id="step-order">
                    <div class="buy-coin-name-big"><span class="logo-blue">BUY</span> {{ $coin->title }}</div>
                    <div class="form-box ">
                        <aside class="buy-form" style="color: rgb(0, 0, 0);">
                            <span class="coin-currency"></span><span class="coin-price"></span> / <span class="coin-multiplier"></span> <span class="coin-tag"></span>
                        </aside>
                        <center class="buy-feedback">Use the form below to get a live price quote and begin your order.</center>
                        <div class="text-line"></div>
                        <input type="text" class="buy-form-input input-full buy-wallet" name="buy-wallet" placeholder="Your wallet address" data-validate="regex" data-regex="^[13][a-km-zA-HJ-NP-Z0-9]{26,36}$" autocomplete="off">
                                                        <input type="text" class="buy-form-input input-half pull-left buy-pounds" name="buy-pounds" placeholder="GBP" autocomplete="off">
                        <input type="text" id="buy-crypto" class="buy-form-input input-half pull-right buy-crypto" name="buy-crypto" placeholder="BTC" autocomplete="off" disabled="">
                        <center>Minimum order £@if ( !$approved ) {{ $setting->min_order1 }} @else {{ $setting->min_order2 }} @endif and maximum order £@if ( !$approved ) {{ $setting->max_order1 }} @else {{ $setting->max_order2 }} @endif<br>Click <a href="/my-account"><b>here</b></a> to get verified and increase your limits.<br>
                        </center>
                        <div class="text-line"></div>
                        <input type="text" class="buy-form-input input-full buy-email" name="buy-email" placeholder="Your email address" data-validate="email" autocomplete="off">
                        <input class="buy-form-input input-half pull-left buy-fname" name="buy-fname" placeholder="First name" type="text" data-validate="name" autocomplete="off">
                        <input class="buy-form-input input-half pull-right buy-sname" name="buy-sname" placeholder="Surname" type="text" data-validate="name" autocomplete="off">
                        <br><br>
                        <label><input type="checkbox" name="buy-bankaccount" class="buy-bankaccount" value="true" autocomplete="off">
                        I have a UK online bank account with faster payments</label><br>
                        <label><input type="checkbox" name="buy-terms" class="buy-terms" value="true" autocomplete="off">
                        I have read and agree with the terms and conditions </label>

                        <button class="buy-form-button buy-button" autocomplete="off" style="margin-top:20px;">Click here to place your order <span class="buy-button-chev">»</span>
                            <span class="buy-button-load">
                                <div class="la-ball-spin-clockwise la-sm"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12" id="step-confirm">
                    <div class="buy-coin-name-big"><span class="logo-blue">CONFIRM</span> ORDER</div>
                    <div class="form-box">
                    <center><h1>Confirm your order details</h1></center>
                    <div class="text-line"></div><br>
                        <div class="container" style="width:100%;">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="confirm-title">PAYMENT INFORMATION</div>
                                    <div class="confirm-data"><span data-load="email" class="confirm-payment-inf"></span></div><br>
                                </div>
                                <div class="col-xs-12">
                                    <div class="confirm-title">ORDER ID</div>
                                    <div class="confirm-data wrap" style="font-size: 16px;"><span class="confirm-orderid"></span></div><br>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="confirm-title">AMOUNT IN GBP</div>
                                    <div class="confirm-data">£<span data-load="gbp-amount" class="confirm-cost"></span></div><br>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="confirm-title">AMOUNT IN Bitcoin</div>
                                    <div class="confirm-data"><span data-load="purchase-amount" class="confirm-price"></span> BTC</div><br>
                                </div>
                            </div>
                        </div>
                        <div class="form-box-footer">
                            <center>Your order is confirmed. Please pay with this payment information and click this button.</center>
                            <br>
                            <!-- <input type="text" class="buy-form-input input-full conf-confcode" name="conf-confcode" placeholder="Your confirmation code" data-validate="guid" autocomplete="off"> -->
                             <button class="buy-form-button confirm-button" autocomplete="off">Click here to confirm your payment 
                             <!--<span class="buy-button-chev">»</span> -->
                                <!-- <span class="buy-button-load">
                                    <div class="la-ball-spin-clockwise la-sm"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                </span> -->
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12" id="step-wait">
                    <div class="buy-coin-name-big">PAYMENT</div>
                    <div class="form-box">
                        <center>
                            <h1>Make your payment</h1>
                            <div class="text-line"></div>
                            Remember to include the <strong>reference code</strong> when making your bank transfer otherwise your order may be delayed or cancelled.<br><br>
                            <div class="vendor-waiting">
                                <br><br>
                                <div class="la-timer la-4x"><div></div></div>
                                <div class="countdown-cont"></div>
                                <br><br>
                                <h2>Please wait while we find a vendor to accept your order!</h2><br>
                                <strong>Info:</strong> This may take a few minutes. This page will automatically update and display banking details to make your payment to once a vendor is found.<br><br>
                                Once your payment has been received, <span data-load="purchase-amount">0.0034</span> BTC will be sent to the wallet address you provided (<span data-load="wallet">3QJmV3qfvL9SuYo34YihAf3sRCW3qSinyC</span>).
                            </div>
                        </center>
                    </div>
                </div>
                
            </div>
            <div class="row row-exception" id="row-timeout">
                <img src="{{ asset('assets/images/tick.png') }}">
                <h2>Timeout</h2>
                <br>
                <h4>Your order has timed out. Please try again later.</h4>
                <br><br>
                <h3>Thank you for using <span>CryptoSeller</span></h3>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
            <div class="row row-exception" id="row-complete">
                <img src="{{ asset('assets/images/tick.png') }}">
                <h2>Complete</h2>
                <br>
                <h4>Your order has completed. If you didn`t receive within 2 hours please contact to jacoub@gmail.com</h4>
                <br><br>
                <h3>Thank you for using <span>CryptoSeller</span></h3>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
        </div>
        <!-- //Services Section End -->
    </div>
    
    <!-- Accordions Section End -->
    <div class="container">
        <!-- Our Skills Start -->
        
        <div class="text-center marbtm10">
            <h3 class="border-danger"><span class="heading_border bg-danger">Our Features</span></h3>
        </div>
            </div>
        <div class="sliders">
            <!-- Our skill Section start -->
            <div class="container">
            <div class="row">
            <div class="col-lg-4  text-center ">
                <div class="ksp-box">
                    <div class="ksp-img fast"></div>
                    <span class="ksp-name">Fast</span><br><br>
                    We aim to deliver your coins within one hour of your order being placed and payment being confirmed. Thanks to <a href="https://en.wikipedia.org/wiki/Faster_Payments_Service">Faster Payments</a>, you are now able to purchase in no time using just your online banking account to purchase.
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="ksp-box">
                    <div class="ksp-img secure"></div>
                    <span class="ksp-name">Secure</span><br><br>
                    We do not store any payment information on our servers. You make your payments through your online banking service, not through a 3rd party processor. All communication is secured through 256-bit SSL.
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="ksp-box">
                    <div class="ksp-img easy"></div>
                    <span class="ksp-name">Easy</span><br><br>
                    Our service couldn't be easier to use. The only thing required from you to use Cryptomate is access to online banking within the UK. Joining the cryptocurrency revolution has never been simpler! More info <a href="https://cryptomate.co.uk/about/">here.</a>
                </div>
            </div>
            
        </div>
            <!-- Our skills Section End -->
        </div>
        <!-- //Our Skills End -->
    </div>
    <!-- //Container End -->
    
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/js/frontend/flipclock.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/owl.carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/wow/js/wow.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/coins.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('assets/js/frontend/wallet-address-validator.min.js') }}"></script> -->
    
    <script>
        var minOrder = '@if ( !$approved ) {{ $setting->min_order1 }} @else {{ $setting->min_order2 }} @endif';
        var maxOrder = '@if ( !$approved ) {{ $setting->max_order1 }} @else {{ $setting->max_order2 }} @endif';
         $(document).ready(function() {
            //$url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH&tsyms=USD,GBP";
            var fsyms = '{{ $coin->code }}';
            var currencies = {"1":"GBP", "2":"USD"};
            var currency = currencies['{{ $setting->currency }}'];
            var url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=" + fsyms + "&tsyms=" + currency;
            $.ajax({
			    url: url,
			    success: function(response){
                    var fee_type = {{ $coin->fee_type }};
                    var fee = {{ $coin->fee }};
                    var price = parseFloat(response['{{ $coin->code }}'][currency]).toFixed(2);
                    var calc_price = parseFloat(parseFloat(price * fee / 100) + parseFloat(price)).toFixed(2);
                    if ( fee_type == 1) {
                        calc_price = parseFloat(price) + parseFloat(fee);
                        console.log(price, fee, calc_price);
                    }
                    $(".coin-currency").html("£");
                    $(".coin-price").html(calc_price);
                    $(".coin-multiplier").html("1");
                    $(".coin-tag").html("{{ $coin->code }}");
			   }
			});
        });
    </script>
    <!--page level js ends-->

@stop
