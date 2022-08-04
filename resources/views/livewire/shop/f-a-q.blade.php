@section('style')
<link href="{{ asset('css/faq.css') }}" rel="stylesheet">
@endsection

<div>
    <div class="container customer-faq mb-5">
        <div class="row">
            <div class="col-lg-12 faq-left">
                <div class="faq-left-content">
                    <div class="faq-title">
                        <h2>FREQUENTLY ASKED QUESTIONS</h2>
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
                                    Click this link to register <span><a href="{{ route('register') }}">{{ route('register') }}</a></span> <br>
                                    <div class="container">
                                        <div class="images">
                                            <img src="{{ asset('images/faq/verify.png') }}" alt="Verfiy">
                                        </div>
                                        <div class="img_modal">
                                          <span class="close"><i class="fas fa-times"></i></span>
                                          <div class="modalContent">
                                            <img src="" class="modalImg" />
                                            <span class="modalTxt"></span>
                                          </div>
                                        </div>
                                      </div>
                                     <p>Once you are registered, you can verify your email address. You can also check the spam folder.</p>
                                    
                                </p>
                            </div>
                        <div class="faq-div faq-div-border">                            
                            <a>How to Place Order</a>
                        </div> 
                            <div id="faq-content-2" class="faq-content">
                                <p>
                                    <div class="container">
                                        <div class="images">
                                            
                                            <img src="{{ asset('images/faq/place_order.jpg') }}" alt="">
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
                                        First, you need to select the product that you want to purchase and choose how many you would like to buy and click Add to Cart. <br>
                                    </span>

                                    <div class="images">
                                            
                                        <img src="{{ asset('images/faq/shopping_cart.jpg') }}" alt="">
                                    </div>
                                    <span class="faq_2">
                                        Once you are done, click the Cart button in the upper right of the page. Review the cart and if the items are correct, click the Checkout button.
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
                                    <p>Once you have verified your account, click the My Account button in the upper right corner of the website. Then click My Address tab, and then click the add new address button.</p>
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
                                      <p>FIil in the required fields and then click the Save Address button when you are done.
                                    </p>
                                </p>
                            </div>
                        <div class="faq-div faq-div-border">
                            <a>Shipping</a>
                        </div>
                            <div id="faq-content-4" class="faq-content">
                                <p>
                                    We are delivering across Lipa and Tanauan City area.
                                    <br><br>
                                    For Lipa City, here are the shipping rates <br>
                                    200 (Standard - next day) <br>
                                    300 (Express - 1 day shipping with 1pm cutoff) <br><br>

                                    For Tanauan City, here are the shipping rates <br>
                                    300 (Standard - next day) <br>
                                    500 (Express - 1 day shipping with 1pm cutoff) <br><br>

                                    For eligibility in Free Shipping, total order should be: <br>
                                    5000 PHP (Lipa City) <br>
                                    8000 PHP (Tanauan City) <br>
                                </p>
                            </div>
                        <div class="faq-div faq-div-border">
                            <a>Payment Method</a>
                        </div>
                            <div id="faq-content-5" class="faq-content">
                                <p>
                                    You can pay via Cash on delivery, GCash or GrabPay.
                                </p>
                            </div>                              
                    </div>
                </div>                            
            </div>
        </div>
    </div>
</div>
<!-- END OF FAQ -->

@section('scripts')
    <script src="{{ asset('js/faq/image_modal.js') }}"></script>
    <script src="{{ asset('js/faq/faq_js.js') }}"></script>
@endsection