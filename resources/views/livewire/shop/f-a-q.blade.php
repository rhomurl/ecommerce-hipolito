@section('style')
<link href="{{ asset('css/faq.css') }}" rel="stylesheet">
@endsection

<div>
     <!-- FAQ -->
     <div>
        <div class="container customer-faq mb-5">
            <div class="row">
                <div class="col-lg-12 faq-left">
                    <div class="faq-left-content">
                        <div class="faq-title">
                            <h2>FAQ</h2>
                        </div>
                        <div class="col faq-text"> 
                            <p>
                                If you have any questions please contact us and we will answer you as quickly as possible.
                            </p>     
                        </div>
                        <div class="faq-divs">
                            <div class="faq-div">
                                <a>How to Register</a>
                            </div>
                                <div id="faq-content-1" class="faq-content">
                                    <p>
                                        1. Click this link to register <span><a href="{{ route('register') }}">{{ route('register') }}</a></span> <br>
                                        <div class="container">
                                            <div class="images">
                                                <img src="{{ asset('images/faq/verify.png') }}" alt="">
                                            </div>
                                            <div class="img_modal">
                                              <span class="close"><i class="fas fa-times"></i></span>
                                              <div class="modalContent">
                                                <img src="" class="modalImg" />
                                                <span class="modalTxt"></span>
                                              </div>
                                            </div>
                                          </div>
                                         <p>2. Once you have registered. Verify your email. You can also check the spam folder.</p>
                                        
                                    </p>
                                </div>
                            <div class="faq-div faq-div-border">                            
                                <a>How to Place Order</a>
                            </div> 
                                <div id="faq-content-2" class="faq-content">
                                    <p>
                                        <div class="container">
                                            <div class="images">
                                                <img src="{{ asset('images/faq/place_order.png') }}" height="auto" alt="">
                                            </div>
                                            <div class="img_modal">
                                              <span class="close"><i class="fas fa-times"></i></span>
                                              <div class="modalContent">
                                                <img src="" class="modalImg" />
                                                <span class="modalTxt"></span>
                                              </div>
                                            </div>
                                          </div>
                                        <span class="faq_2">
                                        1. Select the product that you want to purchase and choose how many you would like to buy and click Add to Cart. <br>
                                        </span>
                                        <span class="faq_2">
                                            2. Once you are done, click the Cart button in the upper right of the page.
                                        </span> <br>
                                        <span class="faq_2">
                                            3. Review your cart and if the products on your cart is added successfully, click the Checkout button.
                                        </span>

                                    </p>
                                </div>
                            <div class="faq-div faq-div-border">
                                <a>How to Add Address</a>
                            </div>
                                <div id="faq-content-3" class="faq-content">
                                    <p>
                                        <div class="container">
                                            <div class="images">
                                                <img src="{{ asset('images/faq/my_address.png') }}" alt="">
                                            </div>
                                            <div class="img_modal">
                                              <span class="close"><i class="fas fa-times"></i></span>
                                              <div class="modalContent">
                                                <img src="" class="modalImg" />
                                                <span class="modalTxt"></span>
                                              </div>
                                            </div>
                                          </div>
                                        <span class="faq_2">
                                            1. Your account must be verified in order to proceed.
                                        </span> <br>
                                        <span class="faq_2">
                                            2. Click the My Account button in the upper right corner of the website.
                                        </span> <br>
                                        <span class="faq_2">
                                            3. Click My Address tab.
                                        </span> <br>
                                        <span class="faq_2">
                                            4. Click the add new address button.
                                        </span> <br>
                                        <div class="container">
                                            <div class="images">
                                                <img src="{{ asset('images/faq/add_address.png') }}" alt="">
                                            </div>
                                            <div class="img_modal">
                                              <span class="close"><i class="fas fa-times"></i></span>
                                              <div class="modalContent">
                                                <img src="" class="modalImg" />
                                                <span class="modalTxt"></span>
                                              </div>
                                            </div>
                                          </div>
                                        <span class="faq_2">
                                            5. FIil in the required fields and then click the Save Address button once you are done.
                                        </span>
                                    </p>
                                </div>
                            <div class="faq-div faq-div-border">
                                <a>Shipping</a>
                            </div>
                                <div id="faq-content-4" class="faq-content">
                                    <p>
                                        "We are delivering across Lipa and Tanauan City area"
                                        <br><br>
                                        1. For Lipa City, here are the shipping rates <br>
                                        a. 200 (Standard - next day) <br>
                                        b. 300 (Express - 1 day shipping with 1pm cutoff) <br><br>

                                        2. For Tanauan City, here are the shipping rates <br>
                                        a. 300 (Standard - next day) <br>
                                        b. 500 (Express - 1 day shipping with 1pm cutoff) <br><br>

                                        3 .For eligibility in Free Shipping, total order should be: <br>
                                        a. 5000 PHP (Lipa City) <br>
                                        b. 8000 PHP (Tanauan City) <br>
                                    </p>
                                </div>
                            <div class="faq-div faq-div-border">
                                <a>Payment Method</a>
                            </div>
                                <div id="faq-content-5" class="faq-content">
                                    <p>
                                        You can pay via <b>Cash on Delivery</b>, <b>PayPal</b>, and <b>Credit Card</b>.
                                        
                                    </p>
                                    
                                </div>                              
                        </div>
                    </div>                            
                </div>
            </div>
        </div>
    </div>
    <!-- END OF FAQ -->
</div>
<!-- END OF FAQ -->

@section('scripts')
    <script src="{{ asset('js/faq/image_modal.js') }}"></script>
    <script src="{{ asset('js/faq/faq_js.js') }}"></script>
@endsection