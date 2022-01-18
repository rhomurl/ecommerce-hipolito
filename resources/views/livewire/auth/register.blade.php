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
                              <input wire:model.lazy="name" id="name" type="text" autofocus class="form-control @error('name') text-warning @enderror" placeholder="Enter your name">
                        @error('name')
                            <p class="mt-2 text-warning">{{ $message }}</p>
                        @enderror
                        </div> <!-- form-group end.// -->
                        {{--<div class="col form-group">
                            <label>Last name</label>
                              <input type="text" class="form-control" placeholder="">
                        </div>--}} <!-- form-group end.// -->
                    </div> <!-- form-row end.// -->
                    <div class="form-group">
                        <label>Email</label>
                        <input wire:model.lazy="email" id="email" type="email" required class="form-control @error('email') text-warning @enderror" placeholder="Enter your email">
                        <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                    @error('email')
                        <p class="mt-2 text-warning">{{ $message }}</p>
                    @enderror
                    </div> <!-- form-group end.// -->

                    {{--<div class="form-group">
                        <label class="custom-control custom-radio custom-control-inline">
                          <input class="custom-control-input" checked="" type="radio" name="gender" value="option1">
                          <span class="custom-control-label"> Male </span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                          <input class="custom-control-input" type="radio" name="gender" value="option2">
                          <span class="custom-control-label"> Female </span>
                        </label>
                    </div> <!-- form-group end.// -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>City</label>
                          <input type="text" class="form-control">
                        </div> <!-- form-group end.// -->
                        <div class="form-group col-md-6">
                          <label>Country</label>
                          <select id="inputState" class="form-control">
                            <option> Choose...</option>
                              <option>Uzbekistan</option>
                              <option>Russia</option>
                              <option selected="">United States</option>
                              <option>India</option>
                              <option>Afganistan</option>
                          </select>
                        </div> <!-- form-group end.// -->
                    </div>--}} <!-- form-row.// -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Create password</label>
                            <input wire:model.lazy="password" id="password" type="password" required class="form-control" type="password">
                        @error('password')
                            <p class="mt-2 text-warning">{{ $message }}</p>
                        @enderror
                        
                        </div> <!-- form-group end.// --> 
                        <div class="form-group col-md-6">
                            <label>Repeat password</label>
                            <input wire:model.lazy="passwordConfirmation" id="password_confirmation" type="password" required class="form-control">
                        </div> <!-- form-group end.// -->  
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