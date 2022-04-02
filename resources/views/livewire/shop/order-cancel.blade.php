<section class="text-gray-600 body-font">
    <div class="row">

      <div class="col-lg-12 ">
          <article class="card first_card">
              <div class="card-body first_card_body">
                  <div class="mt-4 mx-auto text-center" style="max-width:600px">
                      <img src="{{ asset('images/misc/order_failed.png') }}" width="96px" height="96px" alt="">
                      <div class="my-3">
                          <h2>You have cancelled your order</h2>
                          <p>
                              You can place an order again next time!
                          </p>
                      </div>                     
                  </div>
              </div>
              <div class="text-center mb-5">
                <a href="{{ route('user.orders') }}" class="btn ml-2 btn-primary">Go to My Orders</a>
                <a href="{{ route('home') }}" class="btn ml-2 btn-secondary">Go to Home</a>
              </div>
          </article>
          
      </div>
      
  </div>
  
  </section>