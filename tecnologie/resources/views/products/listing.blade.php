@extends('layouts.frontLayout.front_design')
@section('content')

<!-- LOADER-->
<div id="loader">
    <div class="position-center-center">
        <div class="ldr"></div>
    </div>
</div>

<!-- Wrap -->
<div id="wrap">
    <!-- MAIN  CONTENT -->
    <main>

        <!-- HOME MAIN  -->
        <section class="simple-head" data-stellar-background-ratio="0.5">
            <!-- Container Fluid -->
            <div class="container-fluid">
                <div class="position-center-center">
                    <!-- Header Text -->
                    <div class="col-lg-7 col-lg-offset-5"><span class="price"><small></small>
                            @if(!empty($search_product))
                                Ricerca {{ $search_product }}
                            @else
                                Ricerca {{ $categoryDetails->name }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Content -->
        <div id="content">
            <!-- PRODOTTI VARI -->
            <section class="padding-top-100 padding-bottom-100">
                <div class="container">
                    <!-- Main Heading -->
                    <div class="heading text-center">
                        <h4>Prodotti Vari</h4>
                        <span>Mettice quello che te pare</span> </div>
                </div>
                <!-- New Arrival -->
                <div class="arrival-block">
                @foreach($productsAll as $pro)
                    <!-- Item -->
                    <div class="item">
                        <!-- Images -->
                        <img class="img-1" src="{{ asset ('images/backend_images/products/large/'.$pro->image) }}" alt=""> <img class="img-2" src="{{ asset ('images/backend_images/products/large/'.$pro->image) }}" alt="">
                        <!-- Overlay  -->
                        <div class="overlay">
                            <!-- Price -->
                            <span class="price"><small>€</small>{{ $pro->price }}</span>
                            <div class="position-center-center"> <a href="{{ asset ('images/backend_images/products/large/'.$pro->image) }}" data-lighter><i class="icon-magnifier"></i></a> </div>
                        </div>
                        <!-- Item Name -->
                        <div class="item-name"> <a href="{{ url('/product/'.$pro->id) }}">{{ $pro->product_name }}</a>
                            <p></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            <!-- PRIMA DI CATEGORIE -->
            <section class="padding-bottom-150">
                <div class="container">
                    <!-- Main Heading -->
                    <div class="heading text-center">
                        <h4>Categorie</h4>
                        <span>Incredibile quanto questo sito riesca a non vendere nemmeno un prodotto ma avere la sezione popolari!</span> </div>
                    <!-- Popular Item Slide -->
                    <div class="papular-block block-slide">
                        <!-- CATEGORIE -->
                        @foreach($categories as $cat)
                        <div class="item">
                            <!-- Item img -->
                            <div class="item-img">
                                <img class="img-1" src="{{ asset ('images/backend_images/categories/large/'.$cat->image) }}" alt="" >
                                <!-- Overlay -->
                                <div class="overlay">
                                    <div class="position-center-center">
                                        <a href="#." class="btn btn-small btn-round">MOSTRA</a> </div>
                                </div>
                            </div>
                            <!-- Item Name -->
                            <div class="item-name">
                                <a href="#{{$cat->id}}">{{$cat->name}}</a> </div>
                            <!-- Price -->
                        </div>
                            <!--SOTTOCLASSE-->
                            @foreach($cat->categories as $subcat)
                            <div class="item">
                                <!-- Item img -->
                                <div class="item-img">
                                    <img class="img-1" src="{{ asset ('images/backend_images/categories/large/'.$subcat->image) }}" alt="" >
                                    <img class="img-2" src="" alt="" >
                                    <!-- Overlay -->
                                    <div class="overlay">
                                        <div class="position-center-center">
                                            <a href="#." class="btn btn-small btn-round">MOSTRA</a> </div>
                                    </div>
                                </div>
                                <!-- Item Name -->
                                <div id="{{$cat->id}}" class="item-name"> <a href="#.">{{ $subcat->name }}</a> </div>
                                <!-- Price -->
                            </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </section>

        </div>

    </main>
</div>

@endsection

