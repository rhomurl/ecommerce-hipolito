@section('title', 'Sign in to your account')

<section class="section-conten padding-y" style="min-height:84vh">

    <!-- ============================ COMPONENT LOGIN   ================================= -->
        <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
          <div class="card-body">
          <h4 class="card-title mb-4">Sign in</h4>
          <form wire:submit.prevent="authenticate">
                <a href="{{ route('socialLogin.redirect', 'facebook') }}" class="btn btn-facebook btn-block mb-2"> <i class="fab fa-facebook-f"></i> &nbsp;  Sign in with Facebook</a>
                <a href="{{ route('socialLogin.redirect', 'google') }}" class="btn btn-google btn-block mb-4"> <i class="fab fa-google"></i> &nbsp;  Sign in with Google</a>
              <div class="form-group">
                 <input wire:model.lazy="email" placeholder="Enter your email" id="email" name="email" type="email" required autofocus class="form-control">
              </div> <!-- form-group// -->
              @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror

              <div class="form-group">
                <input wire:model.lazy="password" placeholder="Enter your password" id="password" type="password" required  class="form-control">
              </div> <!-- form-group// -->
              @error('password')
                        <p class="text-danger">{{ $message }}</p>
                @enderror
              
              <div class="form-group">
                  <a href="{{ route('password.request') }}" class="float-right">Forgot password?</a> 
                <label class="float-left custom-control custom-checkbox"> 
                    <input wire:model.lazy="remember" value="true" type="checkbox" class="custom-control-input"> <div class="custom-control-label"> Remember </div> </label>
              </div> <!-- form-group form-check .// -->
              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block"> Login  </button>
              </div> <!-- form-group// -->    
          </form>
          </div> <!-- card-body.// -->
        </div> <!-- card .// -->
    
         <p class="text-center mt-4">Don't have account? <a href="{{ route('register') }}">Sign up</a></p>
         <br><br>
    <!-- ============================ COMPONENT LOGIN  END.// ================================= -->
    
    
    </section>