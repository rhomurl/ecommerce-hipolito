<div>
    <div class="widget-header mr-3">
        <a href="{{ route('user.overview') }}" class="widget-view">
            <div class="icon-area">
                <i class="fa fa-user"></i>
            </div>
            <small class="text"> My Account </small>
        </a>
    </div>
    <div class="widget-header mr-3">
        <a href="{{ route('user.wishlists') }}" class="widget-view">
            <livewire:shop.wishlist-icon/>
            <small class="text"> Wishlist </small>
        </a>
    </div>
    <div class="widget-header mr-3">
        <a href="{{ route('user.orders') }}" class="widget-view">
            <div class="icon-area">
                <i class="fa fa-store"></i>
            </div>
            <small class="text"> Orders </small>
        </a>
    </div>
    <div class="widget-header">
        <a href="{{ route('cart') }}" class="widget-view">
            <livewire:shop.cart-icon/>
            <small class="text"> Cart </small>
        </a>
    </div>
</div>