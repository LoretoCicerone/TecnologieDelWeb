@extends('layouts.frontLayout.front_design')
@section('content')
<?php use App\Product; ?>

    <!-- LOADER-->
    <div id="loader">
        <div class="position-center-center">
            <div class="ldr"></div>
        </div>
    </div>
    <!-- Content -->
    <div id="content">
        <!-- Popular Products -->
        <section class="padding-top-100 padding-bottom-100">
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
                        <strong style="color: #0e0e0e">{!! session('flash_message_error') !!}</strong>
                    </div>
                @endif

                <!-- SHOP DETAIL -->
                <div class="shop-detail">
                    <div class="row">

                        <!-- Popular Images Slider -->
                        <div class="col-md-7">

                            <!-- Place somewhere in the <body> of your page -->
                            <div id="slider-shop" class="flexslider">
                                    <li>
                                        <img class="img-responsive" src="{{ asset ('images/backend_images/products/large/'.$productDetails->image) }}" alt="">
                                    </li>
                            </div>
                        </div>

                        <!-- COntent -->
                        <div class="col-md-5">
                            <!-- Sconti Tags
                            <div class="on-sale">  <span>  </span></div>
                            <ul class="item-owner">
                            -->
                            <form name="addtocartForm" id="addtocartForm" action="{{ url('add-cart') }}" method="post">{{csrf_field()}}
                                <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                                <input type="hidden" name="product_name" value="{{ $productDetails->product_name }}">
                                <input type="hidden" name="product_code" value="{{ $productDetails->product_code }}">
                                <input type="hidden" name="price" value="{{ $productDetails->price }}">

                                <h4>{{ $productDetails->product_name }}</h4>
                                <span> {{ $productDetails->product_brand }} &nbsp; {{$productDetails->product_code}}</span>
                                <span class="price">
                                    <?php $getCurrencyRates = Product::getCurrencyRates($productDetails->price);?>
                                    <h3>{{ $productDetails->price }} €</h3>

                                        {{$getCurrencyRates['USD_Rate']}} $<br>
                                        {{$getCurrencyRates['GBP_Rate']}} £<br>

                                </span>

                            &nbsp;
                                <!-- Item Detail -->
                                <p><?php echo nl2br($productDetails->description);?></p>
                                <!-- Short By -->

                            <div class="some-info">
                                <ul class="row margin-top-30">
                                    <li class="col-xs-6">
                                        <div class="quinty" >
                                            <input name="quantity" type="text"  style="border-color: #0f3e68; border-radius: 10px; margin-top: 10px; max-width: 50px; text-align: center; outline: none; font-size: 18px" value="1" required>
                                        </div>
                                    </li>
                                    @if($total_stock>0)
                                        <!-- ADD TO CART -->
                                            <li class="col-xs-6">
                                                <button type="submit" class="btn" id="cartButton" name="cartButton" value="Shopping Cart"
                                                        style="border-radius: 20px; outline: transparent" >
                                                    Nel Carrello
                                                </button>
                                            </li>
                                    @endif
                                    <!-- STOCK -->
                                    <li class="col-xs-6"> <b> Disponibilità:</b>
                                        @if($total_stock>0) <b style="color: green"> In Stock </b> @else <b style="color: red">Out Of Stock</b> @endif
                                    <li class="col-xs-2">
                                        <button type="submit" class="btn" id="wishListButton" name="wishListButton" style="border-radius: 20px;
                                         outline: transparent" value="Wish List" ><i class="fa fa-heart"></i>
                                        </button>
                                    </li>
                                </ul>

                                <b>Cap Check:</b>
                                <input type="text" name="pincode" id="chkPincode" placeholder="Check CAP">
                                <button type="button" onclick="return checkPincode();"
                                        style="border-radius: 20px;background:#2d3a4b;color: white;border:none;font-size: 18px;width: 28px
                                        ;outline: none">✓</button>
                                <p></p>
                                <b id="pincodeResponse"></b>
                                <p></p>

                                <!-- INFOMATION -->
                                <div class="inner-info">
                                    <h6>SHARE THIS PRODUCT</h6>
                                    <!-- Social Icons -->
                                    <ul class="social_icons">
                                        <li><a href="#."><i class="icon-social-facebook"></i></a></li>
                                        <li><a href="#."><i class="icon-social-twitter"></i></a></li>
                                        <li><a href="#."><i class="icon-social-tumblr"></i></a></li>
                                        <li><a href="#."><i class="icon-social-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--======= PRODUCT DESCRIPTION =========-->
                <div class="item-decribe">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs animate fadeInUp" data-wow-delay="0.4s" role="tablist">
                        <li role="presentation" class="active"><a href="#descr" role="tab" data-toggle="tab">DESCRIPTION</a></li>
                        <li role="presentation"><a href="#review" role="tab" data-toggle="tab">REVIEW (03)</a></li>
                        <li role="presentation"><a href="#tags" role="tab" data-toggle="tab">INFORMATION</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content animate fadeInUp" data-wow-delay="0.4s">
                        <!-- DESCRIPTION -->
                        <div role="tabpanel" class="tab-pane fade in active" id="descr">
                            <p>{{ $productDetails->description }}<br>
                            </p>

                            <h6>THE SIMPLE GAY</h6>
                            <ul>
                                <li>
                                    <p>Praesent faucibus, leo vitae maximus dictum,</p>
                                </li>
                                <li>
                                    <p> Donec porta ut lectus </p>
                                </li>
                                <li>
                                    <p> Phasellus maximus velit id nisl</p>
                                </li>
                                <li>
                                    <p> Quisque a tellus et sapien aliquam sus</p>
                                </li>
                                <li>
                                    <p> Donec porta ut lectus </p>
                                </li>
                                <li>
                                    <p> Phasellus maximus velit id nisl</p>
                                </li>
                            </ul>
                        </div>

                        <!-- REVIEW -->
                        <div role="tabpanel" class="tab-pane fade" id="review">
                            <h6>3 REVIEWS FOR SHIP YOUR IDEA</h6>

                            <!-- REVIEW PEOPLE 1 -->
                            <div class="media">
                                <div class="media-left">
                                    <!--  Image -->
                                    <div class="avatar"> <a href="#"> <img class="media-object" src="{{asset('images/frontend_images/avatar-1.jpg')}}" alt=""> </a> </div>
                                </div>
                                <!--  Details -->
                                <div class="media-body">
                                    <p class="font-playfair">“Sono troppo basso e non arrivo a mettere in carica il raosio, però penso sia ottimo!”</p>
                                    <h6>TYRION LANNISTER <span class="pull-right">MAY 10, 2016</span> </h6>
                                </div>
                            </div>

                            <!-- REVIEW PEOPLE 1 -->

                            <div class="media">
                                <div class="media-left">
                                    <!--  Image -->
                                    <div class="avatar"> <a href="#"> <img class="media-object" src="{{asset('images/frontend_images/avatar-2.jpg')}}" alt=""> </a> </div>
                                </div>
                                <!--  Details -->
                                <div class="media-body">
                                    <p class="font-playfair">“Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                        labore et dolore magna aliqua.”</p>
                                    <h6>TYRION LANNISTER <span class="pull-right">MAY 10, 2016</span> </h6>
                                </div>
                            </div>

                            <!-- ADD REVIEW -->
                            <h6 class="margin-t-40">ADD REVIEW</h6>
                            <form>
                                <ul class="row">
                                    <li class="col-sm-6">
                                        <label> *NAME
                                            <input type="text" value="" placeholder="">
                                        </label>
                                    </li>
                                    <li class="col-sm-6">
                                        <label> *EMAIL
                                            <input type="email" value="" placeholder="">
                                        </label>
                                    </li>
                                    <li class="col-sm-12">
                                        <label> *YOUR REVIEW
                                            <textarea></textarea>
                                        </label>
                                    </li>
                                    <li class="col-sm-6">
                                        <!-- Rating Stars -->
                                        <div class="stars"> <span>YOUR RATING</span> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                    </li>
                                    <li class="col-sm-6">
                                        <button type="submit" class="btn btn-dark btn-small pull-right no-margin">POST REVIEW</button>
                                    </li>
                                </ul>
                            </form>
                        </div>

                        <!-- TAGS -->
                        <div role="tabpanel" class="tab-pane fade" id="tags"> </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Products -->
        <section class="light-gray-bg padding-top-150 padding-bottom-150">
            <div class="container">

                <!-- Main Heading -->
                <div class="heading text-center">
                        <h4>PRODOTTI CORRELATI</h4>
                    <span>Qui puoi trovare dei prodotti simili!</span> </div>

                <!-- Popular Item Slide -->
                <div class="papular-block block-slide">
                @foreach($relatedProducts as $chunk)
                    <!-- Item -->
                    <div class="item">
                        <!-- Item img -->
                        <div class="item-img">
                            <img class="img-1" src="{{ asset ('images/backend_images/products/large/'.$chunk->image) }}" alt="" >
                            <!-- Overlay -->
                            <div class="overlay">
                                <div class="position-center-center">
                                    <div class="inn"><a href="{{ asset ('images/backend_images/products/large/'.$chunk->image) }}" data-lighter><i class="icon-magnifier"></i></a>
                                        <a href="#."><i class="icon-basket"></i></a>
                                        <a href="#." ><i class="icon-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item Name -->
                        <div class="item-name"> <a href="{{ url('product/'.$chunk->id) }}">{{ $chunk->product_name }}</a>
                           <!-- <p>Lorem ipsum dolor sit amet</p> -->
                        </div>
                        <!-- Price -->
                        <span class="price"><small>€</small>{{ $chunk->price }}</span>
                    </div>
                @endforeach
                </div>
            </div>
        </section>

    </div>

@endsection
