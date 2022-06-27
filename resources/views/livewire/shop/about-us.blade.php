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
                        <h1 class="about-first-section-title">About us</h1>
                    </div>

                    <div class="about_para1">
                        <p class="about_para">
                            Herminio Hipolito's Hardware and Construction Supply is a store
                            that offers hardware and construction supply and equipments. 
                            We deliver all over Batangas area only.
                        </p>
                    </div>

                    <div class="about-green-check">
                        <i class="fa fa-check">
                            <span class="about_para">Fast response.</span>
                        </i>
                        <br>
                        <i class="fa fa-check">
                            <span class="about_para">Fast delivery.</span>
                        </i>
                        <br>
                        <i class="fa fa-check">
                            <span class="about_para">Very accomidating.</span>
                        </i>
                        <br>
                        <i class="fa fa-check">
                            <span class="about_para">100% Trusted.</span>
                        </i>
                        <br>
                    </div>

                    <div class="about-view-detail-btn">
                        <a class="view-details-btn" href="">Shop now</a>
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
                        <img src="../assets/images/counter_img_1.png" alt="">
                        <h1><span class="counter">986</span></h1>
                        <h3 class="counter-title">Feedbacks</h3>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="counter-box">
                        <img src="../assets/images/counter_img_2.png" alt="">
                        <h1><span class="counter">650</span> <span class="counter-plus-sign">+</span> </h1>
                        <h3 class="counter-title">Satisfied costumers</h3>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="counter-box">
                        <img src="../assets/images/counter_img_3.png" alt="">
                        <h1><span class="counter">1500</span> <span class="counter-plus-sign">+</span> </h1>
                        <h3 class="counter-title">Transactions</h3>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="counter-box">
                        <img src="../assets/images/counter_img_4.png" alt="">
                        <h1><span class="counter">5000</span> <span class="counter-plus-sign">+</span> </h1>
                        <h3 class="counter-title">Products sold</h3>
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
<script>
$(document).ready(function(){
    $('.counter').counterUp({
        delay: 50,
        time: 5000
    });
});
</script>
@endsection