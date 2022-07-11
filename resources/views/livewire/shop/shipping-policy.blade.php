@section('style')
    <link rel="stylesheet" href="{{ asset('css/shipping_policy.css')}}">
@endsection

<div class="container">
    <div class="shipping_policy_section_header">
        <h2>SHIPPING POLICY</h2>
        <ul class="shipping_policy_ul">
            <li>For Lipa City areas, Hipolito's Hardware and Construction Supply aims to deliver the orders within the day with a shipping flat rate of 300 php, while 200 php within next day.</li>
            <li>For Tanauan City areas, Hipolito's Hardware and Construction Supply aims to deliver the orders within the day with a shipping flat rate of 500 php, while 300 php within next day.</li>
        </ul>
    </div>
</div>

<div class="home-who-we-are-wrapper">
        <div class="home-who-we-are">
            <div class="home-who-we-are-content">
                <div class="container">
                    <div class="row">
                        <!--<p class="who-we-are-title">Please take note of the following:</p>!-->
                        <div class="col-lg-6">
                            <h1 class="home-who-we-are-sub-title">We deliver across Lipa City and Tanauan City area only.</h1>
                        </div>
                        <div class="col-lg-6">
                            <div class="home-meet-btn-wrapper">
                                <a class="home-meet-btn btn btn-primary" href="{{ route('products.all') }}">All products</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="home-three-icons"></div>

                    <div class="container">
                        <div class="row">

                            <div class="col-xl-4">
                                <div class="who-we-are-card-wrapper">
                                    <div class="who-we-are-cards">
                                        <div class="who-we-are-cards-content">
                                            <i class="card-imgs fa fa-shipping-fast"></i>
                                            <h2>5,000 PHP minimum order<br>within Lipa City for free shipping</h2>
                                            <p>Delivery within the day if ordered before the 1:00PM cut-off.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="who-we-are-card-wrapper">
                                    <div class="who-we-are-cards">
                                        <div class="who-we-are-cards-content">
                                            <i class="card-imgs fas fa-truck"></i>
                                            <h2>8,000 PHP minimum order<br>within Tanauan City for free shipping</h2>
                                            <p>Delivery within the day if ordered before the 1:00PM cut-off.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="who-we-are-card-wrapper">
                                    <div class="who-we-are-cards">
                                        <div class="who-we-are-cards-content">
                                            <i class="card-imgs fas fa-money-bill"></i>
                                            <h2>Shipping fee</h2>
                                            <p>Shipping fee is based on customer's location.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>

            </div>

        </div>

    </div>

</div>
<br><br><br><br><br>