
@section('title', 'My Wishlists')

<div class="card-body">

    <div class="row">
            @forelse($wishlists as $wishlist)
            <div class="col-md-6">
                <figure class="itemside mb-4">
                    <div class="aside"><img src="{{ asset('storage/') }}/{{$wishlist->products->image}}" class="border img-md"></div>
                    <figcaption class="info">
                        <a href="#" class="title">{{ $wishlist->products->name }}</a>
                        <p class="price mb-2">{{ $wishlist->products->selling_price }}</p>
                        <a wire:click.prevent="addToCart({{ $wishlist->product_id }})" href="#" class="btn btn-secondary btn-sm"> Add to cart </a>
                        <a wire:click.prevent="removefromWishlist({{ $wishlist->id }})" href="#" class="btn btn-danger btn-sm" data-original-title="Remove from wishlist"> <i class="fa fa-times"></i> </a>
                    </figcaption>
                </figure>
            </div> <!-- col.// -->
            @empty
                No wishlists found
            @endforelse

            
        </div> <!-- row .//  -->

        </div>