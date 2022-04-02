@section('title', 'Verify your email address')

<section class="section-content padding-y" style="min-height:84vh;">
    <div class="card mx-auto" style="max-width:520px; margin-top:120px;">
        <article class="card-body">
            <header class="mb-4">
                <h4 class="card-title">Verify your email address</h4>
            </header>
           
           
            
                <p class="text-justify">Thanks for signing up! Please verify your email address by clicking on the link we just emailed to you. You can also check your spam folder. If you didn't receive the email, we can send you another.</p>

                <p class="mt-3">
                    If you did not receive the email, click the button below</a>.
                </p>

                <button wire:click="resend" class="btn btn-block btn-primary">Resend Verification Code</button>
            {{--Thanks for signing up! Please verify your email address by clicking on the link we just emailed to you. 
                You can also check your spam folder. If you didn't receive the email, we can send you another.
                A new verification link has been sent to the email address you provided during registration.--}}


                @if (session('resent'))
                    <p class="text-success text-center mt-3">A fresh verification link has been sent to your email address.</p>
                @endif
        </article>
    </div>
    <p class="text-center mt-4">
        or
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Sign out</p>
        </a>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
</section>