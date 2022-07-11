@section('style')
    <link rel="stylesheet" href="{{ asset('css/about_us.css')}}">
@endsection

<section>

    <div class="container" id="about-second-section">
        <div class="row">

            <div class="col-lg-5">

                <div class="about-img-1">
                    <img class="about-image-1" src="{{ asset('images/misc/hipolito_.jpg')}}" width="460" height="582" alt="">
                </div>

            </div>

            <div class="col-lg-7">

                <div>
                    <div class="about-section-1-title">
                        <h2 class="about-first-section-title">ABOUT US</h2>
                    </div>

                    <div class="about_para1">
                        <p class="about_para">
                            Herminio Hipolito's Hardware and Construction Supply is a store
                            that offers hardware and construction supply and equipments. 
                            We deliver across Lipa city and Tanauan city area only.
                        </p>
                    </div>

                    <div class="about-green-check">
                        <i class="fa fa-check">
                            <span class="about_para">Safe transaction.</span>
                        </i>
                        <br>
                        <i class="fa fa-check">
                            <span class="about_para">Fast processing.</span>
                        </i>
                        <br>
                        <i class="fa fa-check">
                            <span class="about_para">Very accommodating.</span>
                        </i>
                        <br>
                        <i class="fa fa-check">
                            <span class="about_para">100% Trusted.</span>
                        </i>
                        <br>
                    </div>

                    <div class="about-view-detail-btn">
                        <a class="view-details-btn btn btn-primary" href="{{ route('products.all') }}">Shop now</a>    
                    </div>

                </div>

            </div>
            
        </div>
    </div>
    
    <div class="box">

        <div class="container">
            <div class="row counter-wrapper">

                <div class="col-lg-3">
                    <div class="counter-box">
                        <div class="about_svg_img_wrapper_1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 about_svg_1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                       </div>
                        <h3 class="counter-title">Fast Shipping</h3>
                        <p class="about_box_para">
                            We are shipping the orders of the customers based on their selected
                            shipping method. it's either standard or express method.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="counter-box">
                       <div class="about_svg_img_wrapper_2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 about_svg_2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                            </svg>
                       </div>
                        <h3 class="counter-title">Fast Response</h3>
                        <p class="about_box_para">
                            We are responding fast to our customers as fast as necessary, so 
                            that we could answer their questions.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="counter-box">
                        <div class="about_svg_img_wrapper_3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 about_svg_3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                              </svg>
                        </div>
                        <h3 class="counter-title">Customers Support</h3>
                        <p class="about_box_para">
                            One way of communicating with our customers is by making a phone
                            call. So that we could explain things more precisely.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="counter-box">
                        <div class="about_svg_img_wrapper_4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 about_svg_4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                              </svg>
                        </div>
                        <h3 class="counter-title">Flexible Payment</h3>
                        <p class="about_box_para">
                            The customers could choose the payment method that they prefer.
                            They could either pay with paypal, credit card or cash on delivery.  
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>

</section>

<section class="googlemaps-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="our-location-wrapper">
                    {{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1585.9246811201494!2d121.16579988215534!3d13.96059899648237!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd6c816c4bc9f3%3A0xae79eaf289b85675!2sHerminio%20Hipolito's%20Hardware%20%26%20Construction%20Supply!5e1!3m2!1sen!2sph!4v1647860351425!5m2!1sen!2sph" width="100%" height="800" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>--}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1935.9842305010995!2d121.166677!3d13.960483!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xae79eaf289b85675!2sHerminio%20Hipolito&#39;s%20Hardware%20%26%20Construction%20Supply!5e0!3m2!1sen!2sph!4v1648396698855!5m2!1sen!2sph" width="100%" height="800" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="our-location">
                        <h1>Our Location</h1>
                        <p>Brgy. Marauoy, Lipa City, Batangas</p>
                        <p>Email: ecomhipolito@gmail.com</p>
                        <p>Phone: +(63) 995 140 1951</p>
                        <p>Office hours: Monday - Saturday <br>(7:00 am - 7:00 pm)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
{{-- <script>
$(document).ready(function(){
    $('.counter').counterUp({
        delay: 50,
        time: 5000
    });
});
</script> --}}
@endsection