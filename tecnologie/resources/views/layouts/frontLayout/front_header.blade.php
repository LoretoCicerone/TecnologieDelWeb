<!-- SCORRI CATEGORIE DA ELIMINARE -->
<?php /*<div id="cd-nav" class="cd-nav">
    <div class="cd-navigation-wrapper">
        <div class="position-center-center">
            <div class="col-sm-5">

                <!-- Nav -->
                <nav>
                    <ul class="cd-primary-nav">
                        @foreach($categories as $cat)
                        <li class="drop-menu">
                            <a href="#{{$cat->id}}" class="title collapsed" data-toggle="collapse" data-parent="#accoridan">{{$cat->name}}</a></li>
                            <div id="{{$cat->id}}" class="collapse">
                                <div class="well">
                                    <ul>
                                        @foreach($cat->categories as $subcat)
                                        <li>
                                                <a href="{{ asset('products/'.$subcat->url) }}">{{$subcat->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div> */ ?>

<?php
use App\Http\Controllers\Controller;
$categories = Controller::categories();
?>


<!-- header -->
<header class="header-2">
    <div class="sticky">
        <div class="container-fluid">


            <!-- Logo -->
            <div class="logo"> <a href="{{ asset('/') }}"><img class="img-responsive" src="{{asset ('images/frontend_images/logo.png')}}" alt="" ></a> </div>
            <nav class="navbar ownmenu">
                <!-- NAV -->

                <div class="collapse navbar-collapse" id="nav-open-btn">
                    <ul class="nav">
                        <li> <a href="{{ asset('/') }}" >Home</a>
                        </li>
                        <li class="dropdown"> <a href="#." class="dropdown-toggle" data-toggle="dropdown">Marchi</a>
                            <ul class="dropdown-menu">
                                @foreach($categories as $cat)
                                    @foreach($cat->categories as $subcat)
                                <li> <a href="{{ asset('products/'.$subcat->url) }}">{{ $subcat->name }}</a>
                                </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </li>
                        <!-- Two Link Option -->
                        <li class="dropdown"> <a href="#." class="dropdown-toggle" data-toggle="dropdown">Designer</a>
                            <div class="dropdown-menu two-option">
                                <div class="row">
                                    <ul class="col-sm-6">
                                        <li> <a href="shop_01.html">summer store</a></li>
                                        <li> <a href="shop_01.html"> sarees</a></li>
                                        <li> <a href="shop_01.html"> kurtas</a></li>
                                        <li> <a href="shop_01.html"> shorts & tshirts</a></li>
                                        <li> <a href="shop_01.html"> winter wear</a></li>
                                        <li> <a href="shop_01.html"> jeans</a></li>
                                        <li> <a href="shop_01.html"> bra</a></li>
                                        <li> <a href="shop_01.html"> babydools</a> </li>
                                    </ul>
                                    <ul class="col-sm-6">
                                        <li> <a href="shop_01.html">deodornts</a></li>
                                        <li> <a href="shop_01.html"> skin care</a></li>
                                        <li> <a href="shop_01.html"> make up</a></li>
                                        <li> <a href="shop_01.html"> watch</a></li>
                                        <li> <a href="shop_01.html"> siting bags</a></li>
                                        <li> <a href="shop_01.html"> totes</a></li>
                                        <li> <a href="shop_01.html"> gold rings</a></li>
                                        <li> <a href="shop_01.html"> jewellery</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <!-- MEGA MENU -->
                        <li> <a href="{{ url('/orders') }}" >Ordini</a>

                        @if(empty(Auth::check()))
                        <li> <a href="{{url('/login-register')}}"> login</a> </li>
                        @else
                            <li> <a href="{{url('/user-logout')}}"> logout</a> </li>
                        @endif

                    </ul>
                </div>

                <!-- Nav Right -->
                <div class="nav-right">
                    <ul class="navbar-right">

                        <!-- USER INFO -->
                        <li class="dropdown user-acc"> <a href="{{ url('/account') }}" class="dropdown-toggle" role="button" ><i class="icon-user"></i> </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <h6>HELLO! Jhon Smith</h6>
                                </li>
                                <li><a href="#">MY CART</a></li>
                                <li><a href="{{ url('/account') }}">ACCOUNT INFO</a></li>
                                <li><a href="#">LOG OUT</a></li>
                            </ul>
                        </li>

                        <!-- USER BASKET -->
                        <li class="dropdown user-basket"> <a href="{{ url('/cart') }}" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="true"><i class="icon-basket-loaded"></i> </a>

                        </li>

                        <!-- SEARCH BAR -->
                        <li class="dropdown"> <a href="javascript:void(0);" class="search-open"><i class=" icon-magnifier"></i></a>
                            <div class="search-inside animated bounceInUp"> <i class="icon-close search-close"></i>
                                <div class="search-overlay"></div>
                                <div class="position-center-center">
                                    <div class="search">
                                        <form action="{{url ('/search-products')}}" method="post">{{csrf_field()}}
                                            <input type="search" placeholder="Search Product" name="product">
                                            <button type="submit"><i class="icon-check"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
