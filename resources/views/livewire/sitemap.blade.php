@section('styles')
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .sitemap-wrapper {
            margin-top: 50px;
        }
        .sitemap-ul-list {
            margin-top: 40px;
        }
        .sitemap-ul-list a {
            color: black;
        }
    </style>
@endsection

<div class="container mt-5 mb-5">
        <div class="sitemap-wrapper">
        
            <h1 class="sitemap">Sitemap</h1>
    
            <ul class="sitemap-ul-list">
                <li><a target="_blank" href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Brands</a></li>
                <ul>
                    @foreach ($brands as $brand)
                        <li><a target="_blank" href="{{ route('brand.search', $brand->slug) }}">{{ $brand->name }}</a></li>
                    @endforeach
                </ul>
                <li><a href="#">Categories</a></li>
                <ul>
                    @foreach ($categories as $category)
                        <li><a target="_blank" href="{{ route('category.search', $category->slug) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
                
                <li><a target="_blank" href="{{ route('about') }}">About Us</a></li>
                <li><a target="_blank" href="{{ route('shipping.policy') }}">Shipping Policy</a></li>
                <li><a target="_blank" href="{{ route('faq') }}">Frequently Asked Questions</a></li>
                <li><a target="_blank" href="{{ route('login') }}">Sign In</a></li>
                <li><a target="_blank" href="{{ route('register') }}">Sign Up</a></li>
                <li><a target="_blank" href="{{ route('password.request') }}">Forgot Password</a></li>
                <li><a target="_blank" href="{{ route('user.overview') }}">My Account</a></li>
                <ul>
                    <li><a target="_blank" href="{{ route('user.edit') }}">Edit Profile</a></li>
                    <li><a target="_blank" href="{{ route('user.address') }}">My Address</a></li>
                    <li><a target="_blank" href="{{ route('user.wishlists') }}">My Wishlist</a></li>
                    <li><a target="_blank" href="{{ route('user.orders') }}">My Orders</a></li>
                </ul>
                <li><a target="_blank" href="{{ route('cart') }}">Cart</a></li>
                <li><a target="_blank" href="{{ route('checkout.step1') }}">Checkout</a></li>
                <li><a target="_blank" href="{{ route('terms-service') }}">Terms of Service</a></li>
                <li><a target="_blank" href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                <li><a target="_blank" href="{{ route('products.all') }}">All Products</a></li>
            </ul>
            
        </div>
    </div>