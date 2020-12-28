@extends('layouts.frontLayout.front_design')
@section('content')

    <!-- LOADER-->
    <div id="loader">
        <div class="position-center-center">
            <div class="ldr"></div>
        </div>
    </div>


    <!-- Content -->
    <div id="content">
        <!--======= PAGES INNER =========-->
        <section class="padding-top-100 padding-bottom-100 pages-in chart-page">
            <div class="container">

                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block" style="background-color: green">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong style="color: white">{!! session('flash_message_success') !!}</strong>
                    </div>
                @endif
                @if(Session::has('flash_message_error'))
                    <div class="alert alert-error alert-block" style="background-color: red">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong style="color: white">{!! session('flash_message_error') !!}</strong>
                    </div>
                @endif

                <!-- Payments Steps -->
                <div class="shopping-cart text-center">
                    <div class="cart-head">
                        <ul class="row">
                            <!-- PRODUCTS -->
                            <li class="col-sm-2 text-left">
                                <h6>PRODUCTS</h6>
                            </li>
                            <!-- NAME -->
                            <li class="col-sm-4 text-left">
                                <h6>NAME</h6>
                            </li>
                            <!-- PRICE -->
                            <li class="col-sm-2">
                                <h6>PRICE</h6>
                            </li>
                            <!-- QTY -->
                            <li class="col-sm-1">
                                <h6>QNTY</h6>
                            </li>

                            <!-- TOTAL PRICE -->
                            <li class="col-sm-2">
                                <h6>TOTAL</h6>
                            </li>
                            <li class="col-sm-1"> </li>
                        </ul>
                    </div>

                    <?php $total_amount = 0; ?>
                @foreach($userCart as $cart)
                    <!-- Cart Details -->
                    <ul class="row cart-details">

                        <li class="col-sm-6">
                            <div class="media">
                                <!-- Media Image -->
                                <div class="media-left media-middle"> <a class="item-img"> <img class="img-responsive" src="{{asset('images/backend_images/products/large/'.$cart->image)}}" alt=""> </a> </div>

                                <!-- Item Name -->
                                <div class="media-body">
                                    <div class="position-center-center">
                                        <h5>{{$cart->product_name}}</h5>
                                        <p>{{$cart->product_code}}</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- PRICE -->
                        <li class="col-sm-2">
                            <div class="position-center-center"> <span class="price"><small>€</small>{{$cart->price}}</span> </div>
                        </li>

                        <li class="col-sm-1">
                            <div class="position-center-center">
                                <div class="quinty">
                                    <a href="{{ url('/cart/update-quantity/'.$cart->id.'/1')}}">+</a>
                                    <input name="qty" type="text" readonly style="border: transparent; outline: none; font-size: 18px; color: #2d3a4b " value="{{$cart->quantity}}">
                                    @if($cart->quantity>1)
                                        <a href="{{ url('/cart/update-quantity/'.$cart->id.'/-1')}}">-</a>
                                    @endif
                                </div>
                            </div>
                        </li>

                        <!-- TOTAL PRICE -->
                        <li class="col-sm-2">
                            <div class="position-center-center"> <span class="price"><small>€</small>{{$cart->price*$cart->quantity}}</span> </div>
                        </li>
                        <!-- REMOVE -->
                        <li class="col-sm-1">
                            <div class="position-center-center"> <a href="{{ url('/cart/delete-product/'.$cart->id) }}"><i class="icon-close"></i></a> </div>
                        </li>
                    </ul>
                    <?php $total_amount = $total_amount + ($cart->price*$cart->quantity); ?>
                    @endforeach
                </div>
            </div>
        </section>

        <!--======= PAGES INNER =========-->
        <section class="padding-top-100 padding-bottom-100 light-gray-bg shopping-cart small-cart">
            <div class="container">

                <!-- SHOPPING INFORMATION -->
                <div class="cart-ship-info margin-top-0">
                    <div class="row">

                        <!-- DISCOUNT CODE -->
                        <div class="col-sm-7">
                            <h6>COUPON</h6>
                            <form action="{{ url('cart/apply-coupon') }}" method="post">{{ csrf_field() }}
                                <input type="text" name="coupon_code"  placeholder="ENTER YOUR CODE IF YOU HAVE ONE">
                                <button type="submit" class="btn btn-small btn-dark">APPLY CODE</button>
                            </form>
                            <div class="coupn-btn"> <a href="{{ asset('/') }}" class="btn">continue shopping</a> <a href="{{ url('/checkout') }}" class="btn">checkout</a> </div>
                        </div>

                        <!-- SUB TOTAL -->
                        <div class="col-sm-5">
                            <h6>grand total</h6>
                            <div class="grand-total">
                                @foreach($userCart as $cart)
                                <div class="order-detail">
                                    <p>{{$cart->product_name}} <span>€{{$cart->price*$cart->quantity}} </span></p>
                                @endforeach
                                    <!-- SUB TOTAL -->
                                    @if(!empty(Session::get('CouponAmount')))
                                        <p class="all-total">SUB TOTAL<span>€ <?php echo $total_amount; ?> </span></p>
                                        <p class="all-total">COUPON<span>€ <?php echo Session::get('CouponAmount'); ?> </span></p>
                                        <p class="all-total">GRAND TOTAL <span>€ <?php echo $total_amount - Session::get('CouponAmount'); ?></span></p>
                                    @else
                                        <p class="all-total">SUB TOTAL<span>€ <?php echo $total_amount; ?> </span></p>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>


@endsection
