@extends('layouts/default')

{{-- Page title --}}
@section('title')
Home
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
<link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl.carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl.carousel/css/owl.theme.css') }}">
    <!--end of page level css-->
@stop
{{-- slider --}}
@section('top')
    <!--Carousel Start -->
    <div id="owl-demo" class="owl-carousel owl-theme">
        <div class="item">
            <img src="{{ asset('assets/images/banner_1.png') }}" alt="slider-image">
            <article class="img-caption">
                <h1>BUYING DIGITAL CURRENCY MADE SIMPLE WITH CRYPTOMATE</h1>
                <p class="heading-cap"></p>
                <span class="heading-cap">Buy cryptocurrency now via instant online bank transfer!</span><br><br>
                <a class="heading-cap" href="{{ URL::to('aboutus') }}" id="img-button">Learn more about Cryptomate</a>
            </article>
        </div>
        <div class="item">
            <img src="{{ asset('assets/images/banner_2.png') }}" alt="slider-image">
            <article class="img-caption">
                <h1>GET VERIFIED</h1>
                <p class="heading-cap"></p>
                <span class="heading-cap">Our new verification system has launched, allowing you to make orders up to £900.</span><br><br>
                <a class="heading-cap" href="{{ URL::to('login') }}" id="img-button">Click here to verify now</a>
            </article>
        </div>
        <div class="item">
            <img src="{{ asset('assets/images/banner_3.png') }}" alt="slider-image">
            <article class="img-caption" style="left:0%; width:600px;">
                <h1>UK'S BEST PEER-TO-PEER EXCHANGE</h1>
                <p class="heading-cap"></p>
                <span class="heading-cap">Buy <a href="/buy-bitcoin/">Bitcoin</a>, <a href="/buy-litecoin/">Litecoin</a>, <a href="/buy-dash/">Dash</a> and <a href="/#coins">many others</a> easily today with Cryptomate.  Our unique peer-2-peer vendor system ensures that your orders are filled on the fly.</span><br><br>
                <a class="heading-cap" href="{{ URL::to('faq') }}" id="img-button">Click here to read our FAQ</a>
            </article>
        </div>
    </div>
    <!-- //Carousel End -->
@stop

{{-- content --}}
@section('content')
    <!-- Container Start -->
    <div class="container">
        <!-- Service Section Start-->
        <div class="row" id="coins-section">
            <!-- Responsive Section Start -->
            <div class="text-center">
                <h3 class="border-primary"><span class="heading_border bg-primary">Buy Coins</span></h3>
            </div>
           <!-- Coin Section Start -->
           @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="box">
                    <span class="coin-name">{{ $product->title }}</span>
                    <a href="{{ URL::to('coins') }}/{{$product->id}}"><img class="coin-img" style="display:block;" src="{{ asset('uploads/products/') }}/{{ $product->pic_product }} "></a><br>           
                    <span class="price-text">Current price: <span class="price BTC" style="" id="price-{{ $product->code }}"></span></span><br>
                    @if($setting->display_fee)
                    <span class="price-fee">Price Fee: <span class="price BTC" id="fee-{{ $product->code }}">{{ $product->fee }} @if ( $product->fee_type == 1 ) £ @else % @endif</span></span><br>
                    @endif
                    <!-- <span class="price-text"><span class="price BTC space-left" style="">$14839.34/BTC</span></span><br> -->
                    @if($setting->display_quantity)
                    <span class="price-quantity">Quanity: <span class="quantity" style="">45.1543</span></span><br>
                    @endif
                    <a href="{{ URL::to('coins') }}/{{$product->id}}" class="buy-now">Buy now</a>
                </div>
            </div>
            @endforeach
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
@stop

{{-- footer scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/owl.carousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
    <script>
        $(document).ready(function() {
            //$url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH&tsyms=USD,GBP";
            var fsyms = '';
            @foreach($products as $product)
                fsyms += '{{ $product->code }}' + ',';
            @endforeach
            var currencies = {"1":"GBP", "2":"USD"};
            var currency = currencies['{{ $setting->currency }}'];
            if(fsyms)
                fsyms = fsyms.substr(0, fsyms.length - 1);
            var url = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=" + fsyms + "&tsyms=" + currency;
            $.ajax({
			    url: url,
			    success: function(response){
                    
                    @foreach($products as $product)
                        var price = parseFloat(response['{{ $product->code }}'][currency]).toFixed(2);
                        var fee_type = {{ $product->fee_type }};
                        var fee = {{ $product->fee }};
                        var calc_price = parseFloat(parseFloat(price * fee / 100) + parseFloat(price)).toFixed(2);
                        if ( fee_type == 1) {
                            
                            calc_price = parseFloat(price) + parseFloat(fee);
                            console.log(price, fee, calc_price);
                        }
                        $("#price-{{ $product->code }}").html("£" + calc_price + "/" + "{{ $product->code }}");
                    @endforeach
			   }
			});
        });
    </script>
    <!--page level js ends-->
@stop
