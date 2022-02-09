@section('title')
    Account Overview    
@endsection

<div class="card-body">			
    <figure class="icontext">
            <div class="icon">
                <img class="rounded-circle img-sm border" src="{{ asset('images/avatars/avatar3.jpg') }}">
            </div>
            <div class="text">
                <strong> {{ Auth::user()->name }}</strong> <br> 
                <p class="mb-2"> {{ Auth::user()->email }}  </p> 
                <a href="{{ route('user.edit') }}" class="btn btn-primary float-md-left"><i class="fa fa-chevron-right"></i> Edit Profile </a>
            </div>
    </figure>
    <hr>
    <p>
        <i class="fa fa-map-marker text-muted"></i> &nbsp; My address:  
         <br>
         @foreach ($addresses as $address)
             {{ $address->entry_street_address }}, {{ $address->barangay->name }}, {{ $address->barangay->city->name }},  {{ $address->barangay->city->zip }}
         @endforeach
        <a href="#" class="btn-link"> Edit</a>
        
        </p>

    

    <article class="card-group card-stat">
        <figure class="card bg">
            <div class="p-3">
                 <h4 class="title">38</h4>
                <span>Orders</span>
            </div>
        </figure>
        <figure class="card bg">
            <div class="p-3">
                 <h4 class="title">5</h4>
                <span>Wishlists</span>
            </div>
        </figure>
        <figure class="card bg">
            <div class="p-3">
                 <h4 class="title">12</h4>
                <span>Awaiting delivery</span>
            </div>
        </figure>
        <figure class="card bg">
            <div class="p-3">
                 <h4 class="title">50</h4>
                <span>Delivered items</span>
            </div>
        </figure>
    </article>
    

</div> <!-- card-body .// -->