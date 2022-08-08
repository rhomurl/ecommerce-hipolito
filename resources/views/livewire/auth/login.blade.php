@section('title', 'Sign in to your account')

<section class="section-conten padding-y" style="min-height:84vh">
  <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
    <div class="card-body">
    <h4 class="card-title mb-4">Sign in</h4>
    @if ($this->error)
      <div class="alert alert-danger">
          {{ $this->error }}
      </div>
    @endif
    @error('password')
      <p class="text-danger">{{ $message }}</p>
    @enderror
    @error('email')
      <p class="text-danger">{{ $message }}</p>
    @enderror

    <form wire:submit.prevent="authenticate">

          <a href="{{ route('socialLogin.redirect', 'facebook') }}" class="btn btn-light btn-block"> <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/icons/social/facebook.svg" width="20" height="20"> &nbsp; Continue with Facebook</a>
          <a href="{{ route('socialLogin.redirect', 'google') }}" class="btn btn-light btn-block"> <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/icons/social/google.svg" width="20" height="20"> &nbsp; Continue with Google</a>
 
          <p class="text-divider my-4"> Or login with email </p>
        <div class="form-group">
            <input wire:model.lazy="email" placeholder="Enter your email" id="email" name="email" type="email" required autofocus class="form-control">
        </div> <!-- form-group// -->

        <div class="input-group mb-3 ">
          <input type="{{ $visible ? 'text' : 'password' }}" wire:model.lazy="password" class="form-control" placeholder="Password"> 
          <button wire:click="togglePassword" type="button" class="btn btn-light"> <i class="text-muted fa fa-eye"></i> 
          </button> 
        </div>


        
        {{--<div class="form-group">
          <input wire:model.lazy="password" placeholder="Enter your password" id="password" type="password" required  class="form-control">

          
            
        </div> <!-- form-group// -->
      --}}

        
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
</section>