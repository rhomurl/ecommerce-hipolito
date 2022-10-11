

<section class="text-gray-600 body-font">
    <div class="mt-5 mb-5">
        <div class="container">
          <!-- ROW -->
          <div class="row">
      
              <div class="col-lg-8">
                  <article class="card first_card">
                      <div class="card-body first_card_body">
                          <div class="mt-4 mx-auto text-center" style="max-width:600px">
                              <svg 
                              width="96px" height="96px" viewBox="0 0 96 96" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" data-darkreader-inline-stroke="" style="--darkreader-inline-stroke:none;"> <g id="round-check"> <circle id="Oval" fill="#D3FFD9" cx="48" cy="48" r="48" data-darkreader-inline-fill="" style="--darkreader-inline-fill:#004d1b;"></circle> <circle id="Oval-Copy" fill="#87FF96" cx="48" cy="48" r="36" data-darkreader-inline-fill="" style="--darkreader-inline-fill:#007b2a;"></circle> <polyline id="Line" stroke="#04B800" stroke-width="4" stroke-linecap="round" points="34.188562 49.6867496 44 59.3734993 63.1968462 40.3594229" data-darkreader-inline-stroke="" style="--darkreader-inline-stroke:#4fff4b;"></polyline> </g> </g> 
                              </svg>
                              <div class="my-3">
                                  <h4>Thank you for ordering.</h4>
                                  <p>
                                      You've successfully placed an order. Thank you for 
                                      shopping with us!
                                  </p>
                              </div>                     
                          </div>
                          <ul class="steps-wrap mx-auto" style="max-width:600px">
                              <li class="step active">
                                  <span class="icon">1</span>
                                  <span class="text">Order placed</span>
                              </li>
                              <li class="step step_2">
                                <span class="icon icon_2 black_text">2</span>
                                <span class="text black_text">Processing</span>
                            </li>
                              <li class="step step_2">
                                  <span class="icon icon_2 black_text">3</span>
                                  <span class="text black_text">On the way</span>
                              </li>
                              <li class="step step_2">
                                  <span class="icon icon_2 black_text">4</span>
                                  <span class="text black_text">Delivery</span>
                              </li>
                          </ul>
                      </div>
                  </article>
              </div>
      
              <aside class="col-lg-4">
                  <article class="card">
                      <div class="card-body">
                          <h5 class="card-title">Summary</h5>
                          <div class="itemside mb-3">
                              <div class="aside">
                                  <span class="icon-sm text-secondary bg-primary-dark rounded"> 

                                    @if($order->transaction->mode == 'cod')  
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                      </svg>    

                                    @elseif($order->transaction->mode == 'grab_pay')  
                                    {{--GRAB PAY ICON--}}
                                    <svg xmlns="http://www.w3.org/2000/svg" height="50" viewBox=".2 0 423.1 422.9" width="50"><path clip-rule="evenodd" d="m423 315.5c0 2.4-.1 7.3-.2 11.2-.3 9.4-1.1 21.7-2.2 27.3-1.8 8.4-4.3 16.3-7.6 22.9-4.1 7.8-9.1 14.8-15.1 20.8-6.1 6-13.1 11.1-20.8 15.1-6.6 3.3-14.7 6-23.1 7.7-5.5 1.2-17.7 1.8-27.1 2.2-3.8.2-8.9.2-11.2.2h-208.4c-2.3 0-7.3-.1-11.2-.3-9.4-.3-21.7-1.1-27.3-2.3-8.4-1.7-16.2-4.3-22.8-7.6-7.8-4-14.7-9.1-20.8-15.1s-11-12.9-15-20.7c-3.4-6.6-6-14.7-7.7-23-1-5.5-1.9-17.7-2.1-27.2-.1-3.9-.2-8.9-.2-11.2l.1-208.3c0-2.3 0-7.3.1-11.2.3-9.5 1.1-21.8 2.2-27.3 1.7-8.5 4.3-16.3 7.6-22.9 4-7.7 9.2-14.8 15.2-20.8s13-11.1 20.7-15c6.6-3.4 14.6-5.9 23.2-7.6 5.4-1.1 17.6-1.8 27.1-2.2 3.6-.2 8.7-.2 11-.2h208.3c2.4 0 7.4.1 11.2.2 9.6.3 21.8 1.1 27.4 2.3 8.3 1.6 16.3 4.2 22.8 7.6 7.9 4 14.9 9.1 20.9 15.1 6 6.1 11 13.1 15.1 20.9 3.4 6.6 6 14.5 7.7 22.9 1.1 5.6 1.9 17.7 2.2 27.1.2 4 .3 8.9.3 11.2z" fill="#289245" fill-rule="evenodd"/><path d="m311.5 180.1v-41.8h8.6v35.9c-2.3 1.2-5.5 3.4-8.6 5.9m-14.9 12.6c2.7-3.2 5.5-6.4 8.6-9v-45.4h-8.6zm-99.2 33.1c0 11.3 4.5 21.8 12.5 29.9 8.1 8 18.6 12.5 29.8 12.5 4.8 0 9.7-1.1 13-2.7v-8.5c-4.1 1.7-8.9 2.6-13 2.6-18.4 0-33.8-15.4-33.8-33.7v-7.7c0-18.3 15.4-33.7 33.8-33.7 9 0 17.7 3.5 23.9 9.8 6.4 6.3 9.8 14.8 9.8 23.9v50h8.7v-51.6c-.6-10.9-5.3-21.2-13.2-28.8-8.1-7.7-18.3-11.8-29.2-11.8-11.2 0-21.8 4.4-29.8 12.4-8 8.1-12.5 18.6-12.5 29.8zm128.3-20.5c3.8-3.9 8.9-6.1 13.8-6.1 10.7 0 18.8 8.2 18.8 18.8v7.7c0 10.6-8.2 18.8-18.8 18.8-5.1 0-10.1-2.8-13.9-7.9-3.4-4.5-5.7-10.6-6-16l-6.9 8.5c1.3 6.4 4.7 12.5 9.5 17 5 4.5 11.1 7 17.3 7 15.1 0 27.5-12.3 27.5-27.5v-7.7c0-7.2-2.9-14-8.2-19.3-5.2-5.2-12.1-8.1-19.3-8.1-4.5 0-11.7 1.6-20.3 9.3l-.1.1c-2.2 2.3-7.6 7.6-11 11.4-5.5 6-13.5 15.2-20.3 24.3v13.3c7.6-9.8 12-15.1 19.1-23.3 6.4-7.3 14.3-16.4 18.8-20.3m-202.5-16.1v-10.2c-7.7-4.2-16.2-6-27.4-6-11.4 0-22.3 4.1-30.6 11.8-8.2 7.6-12.8 17.7-12.8 28.3v2.7c0 22.2 17.7 40.1 39.5 40.1 17.8 0 25.1-5.8 26.9-7.6v-25.8h-29v8.6h21v12.9h-.1c-2.8 1.1-8.4 3.3-18.9 3.3-8.3 0-16.1-3.3-21.9-9.1-5.9-5.9-9.2-13.9-9.2-22.4v-2.7c0-17.2 16-31.6 34.9-31.6 13.2.1 21 2.3 27.6 7.7m62.5 10.1c3.2 0 6 .5 8.2 1.5 1.1-2.6 2.1-4.8 3.7-7.5-2.3-1.7-7.8-2.7-12-2.7-15.6 0-27.5 11.8-27.5 27.5v50h8.6v-50c.1-11.1 7.8-18.8 19-18.8m-148.3 13.9v2.7c0 14.9 5.7 28.6 15.9 39 10.1 10.3 23.8 15.9 38.5 15.9 11.8 0 22.2-2.6 30.9-8 7.3-4.2 10.6-8.6 10.8-9v-46.1h-43.7v8.6h35.3v34.9c-4.2 4.1-13.9 11.1-33.2 11.1-12.5 0-24.2-4.7-32.6-13.4-8.6-8.7-13.3-20.4-13.3-32.9v-2.7c0-12 5.4-23.8 14.7-32.6 9.5-9 22-13.9 35.1-13.9 12.2 0 20.7 1.9 27.4 6v-9.7c-7.1-3-15.6-4.4-27.4-4.4-31.6 0-58.4 25-58.4 54.5m229.7 54.9v-50c0-15.4-12-27.5-27.4-27.5-7.1 0-14 2.9-19.3 8.1-5.2 5.3-8.1 12.1-8.1 19.3v7.7c0 14.9 12.6 27.5 27.4 27.5 4.1 0 9.7-1.1 13-3.9v-9c-3.4 2.7-8.2 4.2-13 4.2-10.5 0-18.9-8.2-18.9-18.8v-7.7c0-10.7 8.3-18.8 18.9-18.8s18.9 8.2 18.9 18.8v50h8.5zm-81.4-83.7c5.8 0 10.8 1.2 15.4 3.8 2.1-2.7 4.4-4.8 6-6.5-4.8-3.7-13-5.8-21.3-5.8-11.9 0-22.8 4.2-30.4 12-7.7 7.8-12 18.4-12 30.3v50h8.7v-50c-.1-20 13.7-33.8 33.6-33.8m183.6 3.9c-8-8.1-18.7-12.4-29.8-12.4-8.2 0-16.3 2.9-20.8 5.9-9.3 6.2-17.1 13-30.8 30.8v12.8c11.8-15.3 22.8-27.2 31.3-33.9 5.5-4.4 13.3-7.2 20.4-7.2 18.3 0 33.7 15.4 33.7 33.7v7.7c0 9.1-3.5 17.5-10 23.8-6.4 6.5-14.8 9.9-23.8 9.9-15 0-28.3-10.3-31.8-24.4l-6.1 7.2c4.4 14.9 20.3 25.8 37.9 25.8 11.2 0 21.8-4.4 29.8-12.5 8.1-8 12.5-18.6 12.5-29.9v-7.7c0-11-4.4-21.5-12.5-29.6" fill="#fff"/></svg>

                                    @elseif($order->transaction->mode == 'gcash')
                                    <img src="{{ asset('images/payment_gcash.png') }}"/>
                                    @else($order->transaction->mode == 'paypal')
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-label="PayPal" role="img" viewBox="0 0 512 512"><rect width="512" height="512" rx="15%" fill="#fff"/><path fill="#002c8a" d="M377 184.8L180.7 399h-72c-5 0-9-5-8-10l48-304c1-7 7-12 14-12h122c84 3 107 46 92 112z"/><path fill="#009be1" d="M380.2 165c30 16 37 46 27 86-13 59-52 84-109 85l-16 1c-6 0-10 4-11 10l-13 79c-1 7-7 12-14 12h-60c-5 0-9-5-8-10l22-143c1-5 182-120 182-120z"/><path fill="#001f6b" d="M197 292l20-127a14 14 0 0 1 13-11h96c23 0 40 4 54 11-5 44-26 115-128 117h-44c-5 0-10 4-11 10z"/></svg>
                                    @endif

                                  </span>
                              </div>
                              <div class="info lh-sm">
                                  <strong>Order ID: {{ $order->id }}</strong>
                                  <br>
                                  <span class="text-muted">{{ \Carbon\Carbon::parse($order->created_at)->format('l, F j Y') }}<br>
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('h:i A') }}</span>
                              </div>
                          </div>
                          <dl class="dlist-align">
                              <dt>Method:</dt>
                              <dd>
                                @if($order->transaction->mode == 'cod')
                                    Cash on Delivery / Cash on Pickup
                                @elseif($order->transaction->mode == 'paypal')
                                    PayPal
                                @endif
                                </dd>
                          </dl>
                          <dl class="dlist-align">
                              <dt>Billed to:</dt>
                              <dd>{{ auth()->user()->name }} </dd>
                          </dl>
                          {{--<dl class="dlist-align">
                              <dt>Fee:</dt>
                              <dd>$2.00</dd>
                          </dl>--}}
                          <dl class="dlist-align">
                              <dt>Total:</dt>
                              <dd>₱{{ $order->total }}</dd>
                          </dl>
                      </div>
                  </article>
              </aside>
      
          </div>
          <!-- END OF ROW -->
      </div>
    </div>

  </section>

  @section('style')
  <style>

  
  * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
  }
  .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 1px solid rgba(81,88,94,.12);
      box-shadow: 0 0.05rem 0.2rem rgb(0 0 0 / 3%);
      border-radius: 0.35rem;
  }
  .card-body {
      flex: 1 1 auto;
      padding: 1.25rem 1.25rem;
  }
  .text-center {
      text-align: center !important;
  }
  .mt-4 {
      margin-top: 1.5rem !important;
  }
  .mx-auto {
      margin-right: auto !important;
      margin-left: auto !important;
  }
  /*===== SVG =====*/
  img, svg {
      vertical-align: middle;
  }
  svg[Attributes Style] {
      width: 96px;
      height: 96px;
  }
  svg:not(:root) {
      overflow: hidden;
  }
  /*===== END OF SVG =====*/
  .my-3 {
      margin-top: 1rem !important;
      margin-bottom: 1rem !important;
  }
  /*===== THANK YOU FOR ORDER TEXT =====*/
  h4, .h4 {
      font-size: calc(1.275rem + 0.3vw);
  }
  h6, .h6, h5, .h5, h4, .h4, h3, .h3, h2, .h2, h1, .h1 {
      margin-top: 0;
      margin-bottom: 0.3rem;
      font-weight: 600;
      line-height: 1.25;
      /*color: #212529;*/
  }
  h4 {
      display: block;
      margin-block-start: 1.33em;
      margin-block-end: 1.33em;
      margin-inline-start: 0px;
      margin-inline-end: 0px;
      font-weight: bold;
  }
  /*===== END OF THANK YOU FOR ORDER TEXT =====*/
  /*===== THANK YOU FOR ORDER PARAGRAPH =====*/
  p {
      margin-top: 0;
      margin-bottom: 1rem;
      /*color: black;*/
  }
  p {
      display: block;
      margin-block-start: 1em;
      margin-block-end: 1em;
      margin-inline-start: 0px;
      margin-inline-end: 0px;
  }
  /*===== END OF THANK YOU FOR ORDER PARAGRAPH =====*/
  /*===== STEPS WRAP =====*/
  .steps-wrap {
      list-style: none;
      margin: 0;
      padding: 0;
      margin-top: 30px;
      position: relative;
      display: flex;
      border-radius: 30px;
      margin-block-start: 1em;
      margin-block-end: 1em;
      margin-inline-start: 0px;
      margin-inline-end: 0px;
      padding-inline-start: 40px;
  }
  .mx-auto {
      margin-right: auto !important;
      margin-left: auto !important;
  }
  .steps-wrap .step {
      width: 100%;
      text-align: center;
      position: relative;
      flex-grow: 1;
      font-size: 14px;
      line-height: 24px;
  }
  .step {
      display: list-item;
  }
  .steps-wrap .step.active .icon {
      background: #00a524;
      color: #fff;
  }
  .steps-wrap .icon {
      color: #fff;
      display: inline-block;
      position: relative;
      z-index: 10;
      width: 24px;
      height: 24px;
      border-radius: 24px;
      text-align: center;
      /* background: #ccd1d6; */
  }
  .icon_2 {
      display: inline-block;
      position: relative;
      z-index: 10;
      width: 24px;
      height: 24px;
      border-radius: 24px;
      text-align: center;
      background: #ccd1d6;
  }
  .steps-wrap .step.active .text {
      color: black;
      font-weight: bold;
  }
  .steps-wrap .text {
      display: block;
      padding-top: 5px;
      text-align: center;
      /* color: #9da1a7; */
  }
  .step .black_text {
      color: black;
  }
  .steps-wrap .step.active:after {
      background: #00a524;
      height: 4px;
      position: absolute;
      content: " ";
      z-index: 5;
      width: 50%;
      right: 0%;
      top: 10px;
  }
  .steps-wrap .step_2:after {
      background: lightgrey;
      height: 4px;
      position: absolute;
      content: " ";
      z-index: 5;
      width: 50%;
      left: 0%;
      top: 10px;
  }
  .steps-wrap .step_2:before {
      background: lightgrey;
      height: 4px;
      position: absolute;
      content: " ";
      z-index: 5;
      width: 50%;
      right: 0%;
      top: 10px;
  }
  .steps-wrap .step_3:after {
      background: lightgrey;
      height: 4px;
      position: absolute;
      content: " ";
      z-index: 5;
      width: 50%;
      left: 0%;
      top: 10px;
  }
  /*===== END OF STEPS WRAP =====*/
  
  </style>
  
  @endsection