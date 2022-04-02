

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
                          <h5 class="card-title">Receipt</h5>
                          <div class="itemside mb-3">
                              <div class="aside">
                                  <span class="icon-sm text-primary  bg-primary-light rounded"> 

                                    @if($order->transaction->mode == 'cod')  
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                      </svg>    

                                    @else($order->transaction->mode == 'paypal')
                                        <i class="fa fa-paypal"></i>
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
                                    Cash on Delivery
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
                              <dt>Paid:</dt>
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
  @import url(https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css);
  
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
  /*===== RECEIPE CSS =====*/
  .card-title {
      margin-bottom: 1rem;
  }
  .itemside {
      position: relative;
      display: flex;
      width: 100%;
  }
  .mb-3 {
      margin-bottom: 1rem !important;
  }
  .itemside .aside {
      position: relative;
      flex-shrink: 0;
  }
  .icon-sm {
      width: 42px;
      height: 42px;
      font-size: 20px;
  }
  .icon-xs, .icon-sm, .icon-md, .icon-lg {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      flex-shrink: 0;
      flex-grow: 0;
  }
  .rounded {
      border-radius: 0.35rem !important;
  }
  .bg-primary-light {
      background-color: #dbe9ff !important;
  }
  .text-primary {
      color: #0d6efd !important;
  }
  .fa {
      font-family: "Font Awesome 5 Brands";
  }
  .fa-lg {
      font-size: 1.33333em;
      line-height: .75em;
      vertical-align: -0.0667em;
  }
  .fa, .fab, .fal, .far, .fas {
      -moz-osx-font-smoothing: grayscale;
      -webkit-font-smoothing: antialiased;
      display: inline-block;
      font-style: normal;
      font-variant: normal;
      text-rendering: auto;
  }
  .itemside .info {
      padding-left: 0.75rem;
      flex-grow: 1;
  }
  .lh-sm {
      line-height: 1.25 !important;
  }
  strong {
      color: black;
      font-weight: 600;
  }
  .text-muted {
      color: #9da1a7 !important;
  }
  .dlist-align {
      display: flex;
  }
  [class*=dlist-] {
      margin-bottom: 5px;
  }
  dl {
      margin-top: 0;
      margin-bottom: 1rem;
  }
  dl {
      display: block;
      margin-block-start: 1em;
      margin-block-end: 1em;
      margin-inline-start: 0px;
      margin-inline-end: 0px;
  }
  dt {
      display: block;
  }
  .dlist-align dt {
      width: 150px;
      word-wrap: break-word;
      font-weight: normal;
      color: black;
  }
  .dlist-align dd {
      flex-grow: 1;
  }
  [class*=dlist-] dd {
      margin-bottom: 0;
  }
  dd {
      margin-bottom: 0.5rem;
      margin-left: 0;
      color: black;
  }
  dd {
      display: block;
      margin-inline-start: 40px;
  }
  /*===== END OF RECEIPE CSS =====*/
  
  </style>
  
  @endsection