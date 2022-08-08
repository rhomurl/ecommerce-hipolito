
@section('title', 'My Wishlists')

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
            @forelse($wishlists as $key => $wishlist)
            <div class="col-md-6">
                <figure class="itemside mb-4">
                    <div class="aside"><img src="{{ $this->getProductURL($wishlist->products->image) }}" class="border img-md"></div>
                    <figcaption class="info">
                        <a href="#" class="title">{{ $wishlist->products->name }}</a>
                        <p class="price mb-2">{{ $wishlist->products->selling_price }}</p>
                        <a wire:click.prevent="addToCart({{ $wishlist->product_id }})" href="#" class="btn btn-secondary btn-sm"> Add to cart </a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#dialogCenter{{ $key }}">
                            <i class="fa fa-times"></i>
                        </button>
                    </figcaption>
                </figure>
            </div> <!-- col.// -->

            <!-- Modal -->
            <div class="modal fade" id="dialogCenter{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="dialogCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="dialogCenterTitle">Confirm Delete Wishlist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>	
                        <h3>Are you sure?</h3>
                    Do you really want to delete this wishlist?<br>This process cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button wire:click.prevent="removefromWishlist({{ $wishlist->id }})" data-dismiss="modal" type="button" class="btn btn-primary">Delete</button>
                    </div>
                </div>
                </div>
            </div>
        <!-- End Modal -->
            @empty
                No wishlists found
            @endforelse

            
        </div> <!-- row .//  -->


        
</div>