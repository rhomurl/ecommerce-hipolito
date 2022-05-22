@section('title', 'Reset password')

<div class="card mx-auto" style="max-width: 400px; margin-top:100px;">
    <div class="card-body">
    <h4 class="card-title mb-4">Reset Password</h4>
        <p>Don't worry, just enter your email and we'll send you a link to reset your password.</p>
        
        @if ($emailSentMessage)
            <p class="text-success">
                {{ $emailSentMessage }}
            </p>
        @else
        <form wire:submit.prevent="sendResetPasswordLink">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                Email address
            </label>
            <div class="form-group">
                <input wire:model.lazy="email" id="email" name="email" type="email" required autofocus class="form-control @error('email') is-invalid @enderror" />
            </div> <!-- form-group// -->
            @error('email')
                <p class="mt-2 text-sm text-warning">{{ $message }}</p>

                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display(['data-callback' => 'onCallback']) !!}
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
            
        </div>
     
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block"> Send password reset link  </button>
        </div> <!-- form-group// -->    
        </form>
        @endif
    </div> <!-- card-body.// -->
    
  </div><br><br>
@section('scripts')
    <script type="text/javascript">
        var onCallback = function(){
            @this.
            set('recaptcha', grecaptcha.getResponse());
        };
    </script>
@endsection