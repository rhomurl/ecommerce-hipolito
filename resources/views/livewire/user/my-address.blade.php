@section('title', 'My Address')

@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<style>
.modal-body .icon-box {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    border-radius: 50%;
    z-index: 9;
    text-align: center;
    border: 3px solid #f15e5e;
}
.modal-body .icon-box i {
    color: #f15e5e;
    font-size: 46px;
    display: inline-block;
    margin-top: 13px;
}
</style>
@endsection

<div class="card-body">	

    <div class="row">
        @forelse ($addresses as $key => $address)
            <div class="col-md-6">
                <article class="box mb-4">
                    <h6>{{ $address->entry_firstname }} {{ $address->entry_lastname }}</h6>
                    <p>
                        @if($address->entry_company)
                            {{ $address->entry_company }}<br>
                        @endif
                        {{ $address->entry_street_address }}<br>
                        <b>Landmark:</b> {{ $address->entry_landmark }}
                        <br> {{ $address->barangay->name }}, 
                        {{ $address->barangay->city->name }}, 
                        {{ $address->barangay->city->zip }}
                        <br>{{ $address->entry_phonenumber }}  
                    </p>
                    <a wire:click.prevent="setDefault({{ $address->id }})" href="#" class="btn btn-light {{ $address->id == auth()->user()->address_book_id ? 'disabled' : '' }}" aria-disabled="true"> <i class="fa fa-check"></i> {{ $address->id == auth()->user()->address_book_id ? 'Default' : 'Make default' }}</a>
                    <a wire:click.prevent="edit({{ $address->id }})" href="#" class="btn btn-light"> <i class="fa fa-pen"></i> </a>
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#dialogCenter{{ $key }}">
                        <i class="text-danger fa fa-trash"></i>
                      </button>
                </article>
            </div>  <!-- col.// -->

            <!-- Modal -->
            <div class="modal fade" id="dialogCenter{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="dialogCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="dialogCenterTitle">Confirm Delete Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>	
                        <h3>Are you sure?</h3>
                    Do you really want to delete this address?<br>This process cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button wire:click.prevent="delete({{ $address->id }})" data-dismiss="modal" type="button" class="btn btn-primary">Delete</button>
                    </div>
                </div>
                </div>
            </div>
            <!-- End Modal -->
        @empty
            <div class="col-md-6">
                No address found. Add one?
            </div>
        @endforelse
    </div> <!-- row.// -->
    

@if($addresses->count() < 5)  
    <a href="{{ route('user.address.create')}}" class="btn btn-light mb-3"> <i class="fa fa-plus"></i> Add New Address </a>
@endif



</div>

