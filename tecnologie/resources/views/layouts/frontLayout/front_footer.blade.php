<!-- News Letter -->
<section class="news-letter style-2 padding-top-150 padding-bottom-150">
    <div class="container">
        <div class="heading light-head text-center margin-bottom-30">
            <h4>NEWSLETTER</h4>
            <span>Minchia ora ti mandiamo tante di quelle email spam che manco telenorba faceva così tanta pubblicità </span> </div>
        <form>
            <input type="email" placeholder="Mettice l'email se c'hai le palle" required>
            <button type="submit">SEND ME</button>
        </form>
    </div>
</section><!--======= FOOTER =========-->
<footer>


    <div class="container">



        <!-- ABOUT Location -->
        <div class="col-md-3">
            <div class="about-footer"> <img class="margin-bottom-30" src="{{ asset ('images/frontend_images/logo-foot.png') }}" alt="" >
                <p><i class="icon-pointer"></i> Jagiellońska 74, 03-301 Warszawa,  <br>
                    Polonia.</p>
                <p><i class="icon-call-end"></i> +48225196900</p>
                <p><i class="icon-envelope"></i> media@cdprojektred.com</p>
            </div>
        </div>

        <!-- SHOP -->
        <div class="col-md-3">
            <h6>LINK UTILI</h6>
            <ul class="link">
                <li><a href="{{url('page/termini-condizioni')}}"> Termini & Condizioni</a></li>
                <li><a href="{{url('page/about-us')}}"> About Us</a></li>
                <li><a href="{{url('page/privacy-policy')}}"> Privacy</a></li>
            </ul>
        </div>
        <!-- Rights -->
        <div class="rights">
            <p>©  2020 PELISHOP Tutti diritti riservati. </p>
            <div class="scroll"> <a href="#wrap" class="go-up"><i class="lnr lnr-arrow-up"></i></a> </div>
        </div>
    </div>
</footer>
