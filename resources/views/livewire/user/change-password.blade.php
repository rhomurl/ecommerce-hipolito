@section('title', 'Change Password')    

<div>
    <div class="card mb-4">

       
        <div class="col md-3 p-3">
            <a href="{{ route('user.edit') }}" class="btn btn-primary float-md-left"><i class="fa fa-chevron-left"></i> Back to Edit Profile </a>
        </div>
        <div class="card-body">

        {{--@if ($this->success_msg)
        <div class="alert alert-success" role="alert">
            {{ $this->success_msg }}
        </div>
        @endif--}}
        @if(!auth()->user()->password)
           You have logged in via {{ auth()->user()->provider }} account. If you wish to reset your password, click the button below.<br>
           <a href="{{ route('password.request') }}" class="btn btn-primary float-md-left">Reset Password </a>
        @else
       <form wire:submit.prevent="changePassword" class="mb-5">
        {{ csrf_field() }}
        
          <label>Current Password</label>
          @error('current_password')
              <span class="text-danger">
                &nbsp;{{ $message }}
              </span>
          @enderror
          <div class="form-row mb-3">
              <div class="col input-group">
                    <input wire:model="current_password" name="current_password" type="{{ $visible1 ? 'text' : 'password' }}" class="form-control" value="" required>
                    <button wire:click="togglePassword1" type="button" class="btn btn-light"> <i class="text-muted fa fa-eye"></i> 
                    </button> 
                   
              </div> <!-- form-group end.// -->
          </div> <!-- form-row.// -->
          
        
          <label>New Password</label>
          @error('new_password')
            <span class="text-danger">
                &nbsp;{{ $message }}
            </span>
          @enderror
          <div class="form-row mb-3">
            <div class="col input-group">
                
                  <input wire:model="new_password" name="new_password" type="{{ $visible2 ? 'text' : 'password' }}" class="form-control">
                  <button wire:click="togglePassword2" type="button" class="btn btn-light"> <i class="text-muted fa fa-eye"></i> 
                  </button>    
            </div> <!-- form-group end.// -->
        </div> <!-- form-row.// -->
       

        <label>Confirm New Password</label>
        @error('new_confirm_password')
            <span class="text-danger">
                &nbsp;{{ $message }}
            </span>
        @enderror
        <div class="form-row mb-3">
            <div class="col input-group">
                
                  <input wire:model="new_confirm_password" name="new_confirm_password" type="{{ $visible2 ? 'text' : 'password' }}" class="form-control">
                  <button wire:click="togglePassword2" type="button" class="btn btn-light"> <i class="text-muted fa fa-eye"></i> 
                  </button> 
               
            </div> <!-- form-group end.// -->
            
        </div> <!-- form-row.// -->
       

        <a href="{{ route('password.request')}}" class="mb-5">Forgot Password?</a>
        

          <button class="btn btn-primary btn-block mt-3">Save</button>
        </form>

        @endif
        </div> <!-- card-body.// -->
      </div>
</div>
