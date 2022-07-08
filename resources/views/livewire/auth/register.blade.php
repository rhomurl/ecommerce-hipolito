@section('title', 'Create a new account')

<section class="section-content padding-y">
    <!-- ============================ COMPONENT REGISTER   ================================= -->
        <div class="card mx-auto" style="max-width:520px; margin-top:40px;">
          <article class="card-body">
            <header class="mb-4"><h4 class="card-title">Sign up</h4></header>
            <form wire:submit.prevent="register">
                    <div class="form-row">
                        <div class="col form-group">
                            <label>Name</label>
                              <input wire:model.lazy="name" id="name" type="text" required autofocus class="form-control" placeholder="Enter your name">
                              <small class="form-text text-muted">This cannot be changed later.</small>
                        @error('name')
                            <p class="mt-2 text-warning">{{ $message }}</p>
                        @enderror
                        </div> 
                    </div> <!-- form-row end.// -->

                    <div class="form-group">
                        <label>Email</label>
                        <input wire:model.lazy="email" id="email" type="email" required class="form-control @error('email') text-warning @enderror" placeholder="Enter your email">
                        <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                    @error('email')
                        <p class="mt-2 text-warning">{{ $message }}</p>
                    @enderror
                    </div> <!-- form-group end.// -->

                    
                    <label>Create password</label>
                    <div class="input-group mb-3">
                        <input wire:model.lazy="password" id="password" type="{{ $visible ? 'text' : 'password' }}" required class="form-control" type="password">
                        <button wire:click="togglePassword" type="button" class="btn btn-light"> <i class="text-muted fa fa-eye"></i> 
                        </button> 
                        <small class="form-text text-muted @error('password') d-none @enderror">Password must be at least 8 characters. It should contain at least 1 lowercase, uppercase, number, and special character (@$!%*#?&).</small>
                    </div> <!-- form-group end.// --> 
                    
                    @error('password')
                        <p class="mt-2 text-warning">{{ $message }}</p>
                    @enderror
                    
                    <label>Confirm password</label>
                    <div class="input-group mb-3">
                        <input type="{{ $visible ? 'text' : 'password' }}"  wire:model.lazy="passwordConfirmation" required class="form-control">
                        <button wire:click="togglePassword" type="button" class="btn btn-light"> <i class="text-muted fa fa-eye"></i> 
                        </button> 
                    </div> <!-- form-group end.// -->  
                    @error('passwordConfirmation')
                        <p class="mt-2 text-warning">{{ $message }}</p>
                    @enderror
                        
                    <div class="form-group mt-2">
                        <div wire:ignore>
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display(['data-callback' => 'onCallback']) !!}
                        </div>
                        @error('recaptcha')
                            <p class="mt-2 text-warning">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Register  </button>
                    </div> <!-- form-group// -->           
                </form>
            </article><!-- card-body.// -->
        </div> <!-- card .// -->
        <p class="text-center mt-4">Have an account? <a href="{{ route('login') }}">Log In</a></p>
        <br><br>
    <!-- ============================ COMPONENT REGISTER  END.// ================================= -->

</section>
@section('scripts')
    <script type="text/javascript">
        var onCallback = function(){
            @this.
            set('recaptcha', grecaptcha.getResponse());
        };
    </script>
@endsection