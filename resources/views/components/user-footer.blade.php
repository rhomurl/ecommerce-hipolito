<footer class="section-footer bg-secondary text-white">
    <div class="container">
        <section class="footer-top  padding-y-lg">
            <div class="row">
                @if(!Request::is('about-us'))
                    <aside class="col-md-4 col-12">
                        <article class="mr-md-4">
                            <h5 class="title">Contact us</h5>
                            <p>We are selling different construction materials like base plate, steel bars, cement, construction supplies and equipments, lumber and one bagger is also available for rent (A frame).</p>
                            <ul class="list-icon">
                                <li> <i class="icon fa fa-map-marker"> </i>Brgy. Marauoy, Lipa City, Batangas</li>
                                <li> <i class="icon fa fa-envelope"> </i> hipolitoshardware@gmail.com</li>
                                <li> <i class="icon fa fa-phone"> </i> +(63) 995 140 1951 (SMS/Viber)</li>
                                <li> <i class="icon fa fa-clock"> </i>Mon - Sat 7:00 am - 7:00 pm</li>
                            </ul>
                        </article>
                    </aside>
                @endif
                <aside class="col-md col-6">
                    <h5 class="title">Information</h5>
                    <ul class="list-unstyled">
                        <li> <a href="{{ route('about') }}">About Us</a></li>
                        <li> <a href="{{ route('shipping.policy') }}">Shipping Policy</a></li>
                        <li> <a href="#">Privacy Policy</a></li>
                        <li> <a href="#">Rules and terms</a></li>
                        <li> <a href="#">Sitemap</a></li>
                    </ul>
                </aside>
                <aside class="col-md col-6">
                    <h5 class="title">My Account</h5>
                    <ul class="list-unstyled">
                        <li> <a href="{{ route('user.overview') }}">User Overview</a></li>
                        <li> <a href="{{ route('user.orders') }}">Order status</a></li>
                        <li> <a href="{{ route('user.address') }}">Shipping Address</a></li>
                    </ul>
                </aside>
                <aside class="col-md-4 col-12">
                    <h5 class="title">We Accept</h5>
                    <img src="{{ asset('images/misc/payment-paypal.png') }}">
                    <img src="{{ asset('images/misc/cod_payment.jpg') }}" class="ml-3" width="100px" height="50px">

                

                    <p class="text-white-50 mb-2">Follow us on Facebook</p>
                    <div>
                        <a href="https://www.facebook.com/herminiohipolitoshardware" target="_blank" class="btn btn-icon btn-outline-light"><i class="fab fa-facebook-f"></i></a>
                    </div>

                </aside>
            </div> <!-- row.// -->
        </section>	<!-- footer-top.// -->

        <section class="footer-bottom text-center">
            <p class="text-muted"> &copy 2022 Hipolito's Hardware, All rights reserved </p>
            <br>
    </section>
    </div><!-- //container -->
</footer>