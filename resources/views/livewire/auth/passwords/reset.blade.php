@section('title', 'Reset password')

<div class="card mx-auto" style="max-width: 400px; margin-top:100px;">
    <div class="card-body">
    <h2 class="card-title mb-4">Reset password</h2>

        <form wire:submit.prevent="resetPassword">
        <input wire:model="token" type="hidden">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                    Email address
                </label>
                <div class="form-group">
                    <input wire:model.lazy="email" id="email" name="email" type="email" required autofocus class="form-control @error('email') is-invalid @enderror" />
                </div> <!-- form-group// -->
                
                @error('email')
                    <p class="mt-2 text-sm text-warning">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                    Password
                </label>
                <div class="input-group">
                    <input wire:model.lazy="password" id="password" type="{{ $visible ? 'text' : 'password' }}" required autofocus class="form-control @error('password') is-invalid @enderror" />
                    <button wire:click="togglePassword" type="button" class="btn btn-light"> <i class="text-muted fa fa-eye"></i> 
                    </button> 
                </div> <!-- form-group// -->
                <small class="form-text text-muted">Password must be at least 8 characters. It should contain at least 1 lowercase, uppercase, number, and special character (@$!%*#?&).</small>
                @error('password')
                    <p class="mt-2 text-sm text-warning">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3 mt-2">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 leading-5">
                    Confirm Password
                </label>
                <div class="input-group">
                    <input wire:model.lazy="passwordConfirmation" id="password_confirmation" type="{{ $visible ? 'text' : 'password' }}" required autofocus class="form-control @error('password') is-invalid @enderror" />
                    <button wire:click="togglePassword" type="button" class="btn btn-light"> <i class="text-muted fa fa-eye"></i> 
                    </button> 
                </div> <!-- form-group// -->
            </div>

     
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Reset password</button>
        </div> <!-- form-group// -->    
        </form>

    </div> <!-- card-body.// -->
    
  </div><br><br>