<?php
use App\Http\Controllers\Controller;
$mainCategories = Controller::mainCategories();
?>

@extends('layouts.frontLayout.front_design')
@section('content')

<!-- LOADER-->
<div id="loader">
    <div class="position-center-center">
        <div class="ldr"></div>
    </div>
</div>

        <!-- HOME MAIN  -->
        <section class="home-slider simple-head" data-stellar-background-ratio="0.5">

            <!-- Container Fluid -->
            <div class="container-fluid">
                <div class="position-center-center">

                    <!-- Header Text -->
                    <div class="col-lg-7 col-lg-offset-5"><span class="price"><small></small>Benvenuti</span>
                        <h4>Vi Presentiamo PELISHOP</h4>
                        <h1 class="extra-huge-text">dacci un taglio alla tua vita di merda</h1>
                        <div class="text-center"> <a href="https://www.youtube.com/watch?v=Zjef6uzfVwQ" class="btn btn-round margin-top-40">accedi</a> </div>
                    </div>
                </div>
            </div>

        </section>

<!--   EVENTUALE BANNER, DECIDERE SE METTERLO, NEL CASO DA VIDEO 54 A 57    -->

        <!-- Content -->
        <div id="content">
            <!-- PRIMA DI CATEGORIE -->
            <section class="padding-bottom-150">
                <div class="container">

                    <!-- Main Heading -->
                    <div class="heading text-center">
                        <h4>categorie principali</h4>
                        <span>Qui puoi vedere le nostre principali categorie!</span> </div>

                    <!-- Popular Item Slide -->
                    <div class="papular-block block-slide">

                        <!-- CATEGORIE -->
                        @foreach($mainCategories as $cat)
                            <div class="item">
                                <!-- Item img -->
                                <div class="item-img">
                                    <img class="img-1" src="{{ asset ('images/backend_images/categories/large/'.$cat->image) }}" alt="" >
                                    <!-- Overlay -->
                                    <div class="overlay">
                                        <div class="position-center-center">
                                            <a href="{{ asset('products/'.$cat->url) }}" class="btn btn-small btn-round">MOSTRA</a> </div>
                                    </div>
                                </div>
                                <!-- Item Name -->
                                <div class="item-name">
                                    <a href="{{ asset('products/'.$cat->url) }}">{{$cat->name}}</a> </div>
                                <!-- Price -->
                            </div>
                        @endforeach
                            <!--SOTTOCLASSE DA ELIMINARE-->
                            <?php /* @foreach($cat->categories as $subcat)
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
                            @endforeach */?>
                    </div>
                </div>
            </section>



            <!-- CATEGORIE DA ELIMINARE -->
        <?php /*      <section class="padding-top-150 padding-bottom-150">
                <div class="container">
                    <!-- Main Heading -->
                    <div class="heading text-center">
                        <h4>Prodotti</h4>
                        <span>Fai un giro tra i nostri principali prodotti e lasciati tagliare i peli!</span> </div>
                    <div class="new-arrival-list">
                        <ul class="row">
                            <!-- INIZIO -->
                            @foreach($categories as $cat)
                            <li class="col-md-6">
                                <article><img class="img-responsive" src="{{ asset ('images/backend_images/categories/large/'.$cat->image) }}" alt="">
                                    <div class="position-center-center">
                                        <h4><a href="#{{$cat->id}}" >{{ $cat->name }}</a></h4>
                                        <a href="#." class="btn btn-small btn-round">MOSTRA</a> </div>
                                </article>
                            </li>
                            @foreach($cat->categories as $subcat)
                            <li class="col-md-6">
                            <article> <img class="img-responsive" src="{{ asset ('images/backend_images/categories/large/'.$subcat->image) }}" alt="">
                                <div id="{{$cat->id}}" class="position-center-center">
                                    <h4><a href="#.">{{ $subcat->name }}</a></h4>
                                    <a href="#." class="btn btn-small btn-round">MOSTRA</a> </div>
                            </article>
                            </li>
                                @endforeach
                            @endforeach
                        </ul>
                        <!-- SHOW MORE -->
                        <div class="text-center margin-top-50"> <a href="#." class="btn btn-small btn-round"> SHOW MORE...</a> </div>
                    </div>

                </div>
            </section>   */?>


            <!-- PRODOTTI FEATURES -->
            <section class="padding-top-100 padding-bottom-100">
                <div class="container">

                    <!-- Main Heading -->
                    <div class="heading text-center">
                        <h4>Prodotti Consigliati</h4>
                        <span>Questi hanno pagato un sacco per stare qua, comprate qualcosa per favore</span> </div>
                </div>


                <!-- New Arrival -->
                <div class="arrival-block">
                @foreach($productsAll as $product)
                    <!-- Item -->
                    <div class="item">
                        <!-- Images -->
                        <img class="img-1" src="{{ asset ('images/backend_images/products/large/'.$product->image) }}" alt="">
                        <img class="img-2" src="{{ asset ('images/backend_images/products/large/'.$product->image) }}" alt="">
                        <!-- Overlay  -->
                        <div class="overlay">
                            <!-- Price -->
                            <span class="price"><small>€</small>{{ $product->price }}</span>
                            <div class="position-center-center"> <a href="{{ asset ('images/backend_images/products/large/'.$product->image) }}"
                                                                    data-lighter><i class="icon-magnifier"></i></a> </div>
                        </div>
                        <!-- Item Name -->
                        <div class="item-name"> <a href="{{ url('product/'.$product->id) }}">{{ $product->product_name }}</a>
                            <p></p>
                        </div>
                    </div>
                    @endforeach
                    @if(empty($search_product))
                    <!--{{$productsAll->links()}} vedere video 107-->
                    @endif

                </div>
            </section>


        </div>


@endsection

