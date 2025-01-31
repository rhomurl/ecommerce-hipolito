@section('title', 'Edit Profile')    

<div>
    <div class="card mb-4">

       
        <div class="col md-3 p-3">
            <a href="{{ route('user.overview') }}" class="btn btn-primary float-md-left"><i class="fa fa-chevron-left"></i> Back to Account Overview </a>
        </div>
        <div class="card-body">

        @if ($this->success_msg)
        <div class="alert alert-success" role="alert">
            {{ $this->success_msg }}
        </div>
        @endif
    
       <form wire:submit.prevent="edit" class="mb-5">
        {{ csrf_field() }}
          <div class="form-row">
              <div class="col form-group">
                  <label>Name</label>
                    <input wire:model="name" name="name" type="text" class="form-control" value="" disabled>
                    @error('name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
              </div> <!-- form-group end.// -->
          </div> <!-- form-row.// -->

          <div class="form-row">
            <div class="col form-group">
                <label>Email</label>
                  <input wire:model="email" name="email" type="text" class="form-control">
                  <small class="form-text text-muted">By changing this, you will be asked to verify your new email.</small>
              @error('email')
                <p class="mt-2 text-danger">{{ $message }}</p>
              @enderror
                </div> <!-- form-group end.// -->
          </div> <!-- form-row.// -->

          <div class="form-row">
            <div class="col form-group">
                <label>Password</label><br>
                <a href="{{ route('user.change-password') }}" class="btn btn-secondary float-md-left">Change Password</a>
            </div> <!-- form-group end.// -->
          </div> <!-- form-row.// -->

          <button class="btn btn-primary btn-block mt-2">Save</button>
        </form>
        </div> <!-- card-body.// -->
      </div>
</div>
