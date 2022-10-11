@section('style')
<link href="{{ asset('css/faq.css') }}" rel="stylesheet">
@endsection

<div>
    <section class="mb-5">
        <!-- FAQ_TITLE -->
        <div class="container">
            <div class="row">
                <div class="faq_wrapper">
                
                    <div class="faq_title">
                        <h2>FREQUENTLY ASKED QUESTIONS</h2>
                    </div>
                    <div class="faq_first_para">
                        <p>If you have any questions please contact us and we will answer you as quickly as possible.</p>
                    </div>
    
                </div>
            </div>
        </div>
        <!-- END OF FAQ_TITLE -->
        <!-- FAQ_CONTENT -->
        <div class="faq_content_wrapper">
            <div class="container">
                <div class="row">
                    <!-- FIRST_ROW -->
                    <div class="col-lg-3 faq_content_first_title">
                        <h5>ACCOUNT</h5>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-5">
                                <p>How do i register?</p>
                            </div>
                            <div class="col-lg-7">
                                <p>To register, simply follow these steps:</p>
                                <span>1. Click this link
                                    <a href="{{ route('register') }}">click here</a>
                                    and fill up all the required input fields.
                                </span>
                                <br>
                                <span>2. Once you have successfully registered. Verify your email address. You can also check your spam folder.</span>
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
                            </div>
                        </div>
                    </div>
                    <!-- NESTED_ACCOUNT -->
                    <div class="col-lg-3 faq_content_first_title faq_content_nested_account">
                        <h5>ACCOUNT</h5>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-5 faq_content_nested_account_content">
                                <p>How do i add my address?</p>
                            </div>
                            <div class="col-lg-7 faq_content_nested_account_content">
                                <p>To add your address, simply follow these steps:</p>
                                <span>1. Log in with your account.</span>
                                <br>
                                <span>2. Your account must be verified in order to add an address.</span>
                                <br>
                                <span>3. Click the My Account button in the upper right corner of the website.</span>
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
                                <span>4. Click My Address tab.</span>
                                <br>
                                <span>5. Click the add new address button.</span>
                                <br>
                                <span>6. FIil up all the required fields and then click the Save Address button once you are done.</span>
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
                            </div>
                        </div>
                    </div>
                    <!-- END OF NESTED_ACCOUNT -->
                    <!-- END OF FIRST_ROW -->
                    <!-- SECOND_ROW -->
                    <div class="col-lg-3 faq_content_second_title faq_second_row">
                        <h5>ORDERS</h5>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-5 faq_second_row">
                                <p>How do i place an order?</p>
                            </div>
                            <div class="col-lg-7 faq_second_row">
                                <p>To place an order, simply follow these steps:</p>
                                <span>1. Log in with your account.</span>
                                <br>
                                <span>1. Search for the products that you want to purchase.</span>
                                <br>
                                <span>3. Click the product and edit the quantity of the products that you have selected and then click Add to Cart button.</span>
                                <div class="container">
                                    <div class="images">
                                        <img src="{{ asset('images/faq/selected_product.jpg') }}" alt="">
                                    </div>
                                    <div class="img_modal">
                                    <span class="close"><i class="fas fa-times"></i></span>
                                    <div class="modalContent">
                                        <img src="" class="modalImg" />
                                        <span class="modalTxt"></span>
                                    </div>
                                    </div>
                                </div>
                                <span>4. Once you've added products on your cart, click the Cart button in the upper right corner of the website.</span>
                                <br>
                                <div class="images">
                                    <img src="{{ asset('images/faq/shopping_cart.jpg') }}" alt="">
                                </div>
                                <span>5. Review your cart and if the products on your cart is added successfully, click the Checkout button.</span>
                                <br>
                                <span>6. Add or edit your address, then select the shipping type and payment method that you prefer and then click the place order button.</span>
                            </div>
                        </div>
                    </div>
                    <!-- END OF SECOND_ROW -->
                    <!-- THIRD_ROW -->
                    <div class="col-lg-3 faq_content_second_title faq_second_row">
                        <h5>SHIPPING</h5>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-5 faq_second_row">
                                <p>What are the shipping types?</p>
                            </div>
                            <div class="col-lg-7 faq_second_row">
                                <p>We are delivering across Lipa and Tanauan City area:</p>
                                <span>1. For Lipa City, here are the shipping rates:</span>
                                <br>
                                <span>a. 200 (Standard - next day)</span>
                                <br>
                                <span>b. 300 (Express - 1 day shipping with 1pm cutoff)</span>
                                <br>
                                <span>2. For Tanauan City, here are the shipping rates:</span>
                                <br>
                                <span>a. 300 (Standard - next day)</span>
                                <br>
                                <span>b. 500 (Express - 1 day shipping with 1pm cutoff)</span>
                                <br>
                                <span>3. For eligibility in Free Shipping, total order should be:</span>
                                <br>
                                <span>a. 5000 PHP (Lipa City)</span>
                                <br>
                                <span>b. 8000 PHP (Tanauan City)</span>
                            </div>
                        </div>
                    </div>
                    <!-- END OF THIRD_ROW -->
                    <!-- FOURTH_ROW -->
                    <div class="col-lg-3 faq_content_second_title faq_second_row">
                        <h5>PAYMENT METHOD</h5>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-5 faq_second_row">
                                <p>What kind of payment methods do you have?</p>
                            </div>
                            <div class="col-lg-7 faq_second_row">
                                <p>We have 3 kinds of payment methods:</p>
                                <span>1. Cash on Delivery/Cash on Pickup</span>
                                <br>
                                <span>2. PayPal</span>
                                <br>
                                <span>3. Credit Card</span>
                                <br>
                            </div>
                        </div>
                    </div>
                    <!-- END OF FOURTH_ROW -->
                </div>
            </div>
        </div>
        <!-- END OF FAQ_CONTENT -->
    </section>
</div>
<!-- END OF FAQ -->

@section('scripts')
    <script src="{{ asset('js/faq/image_modal.js') }}"></script>
    <script src="{{ asset('js/faq/faq_js.js') }}"></script>
@endsection