@section('title')
    Account Overview    
@endsection

<div class="card-body">			
    <figure class="icontext">
            <div class="icon">
                <img class="rounded-circle img-sm border" src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->name }}">
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
             <a href="{{ route('user.address.edit', $address->id)}}" class="btn-link">[Edit]</a>
             @endforeach
        
        
        </p>

    

    <article class="card-group card-stat">
        <figure class="card bg">
            <div class="p-3">
                 <h4 class="title">{{ $this->order_count }}</h4>
                <span>Total Orders</span>
            </div>
        </figure>
        <figure class="card bg">
            <div class="p-3">
                 <h4 class="title">{{ $this->order_processing_count }}</h4>
                <span>Paid Orders</span>
            </div>
        </figure>
        <figure class="card bg">
            <div class="p-3">
                 <h4 class="title">{{ $this->total_delivered }}</h4>
                <span>Delivered Orders</span>
            </div>
        </figure>
    </article>
    

</div> <!-- card-body .// -->