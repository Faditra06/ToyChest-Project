<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="ToyChest Product Details">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToyChest</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css1/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css1/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css1/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css1/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css1/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css1/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css1/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css1/style.css') }}" type="text/css">
</head>

<body>
    

    <!-- Header Section -->
    <x-app-layout></x-app-layout>

    <!-- Shop Details Section Begin -->
    <section class="shop-details pb-16">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Thumbnail Image -->
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <!-- Hanya 1 gambar, tidak perlu foreach -->
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ asset('storage/' . $product->image) }}">
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Main Image -->
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    @else
                                    <p>No image available</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product->name }}</h4>
                            <div class="rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa {{ $i <= $product->rating ? 'fa-star' : 'fa-star-o' }}"></i>
                                    @endfor
                                    <span> - {{ $product->reviews_count }} Reviews</span>
                            </div>
                            <h3>Rp {{ number_format($product->price, 0, ',', '.') }}
                                @if ($product->discount_price)
                                <span>Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
                                @endif
                            </h3>
                            <p>{{ $product->description }}</p>

                            <!-- Cart & Buy -->
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty rounded-full">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                                <a href="{{ route('checkout', $product->id) }}" class="primary-btn rounded-full bg-toychest1 hover:bg-toychest2 hover:text-white transition ease-in-out duration-300">Buy</a>
                            </div>
                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-cart-shopping"></i> add to cart</a>
                            </div>

                            <!-- Additional Info -->
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="{{ asset('img/shop-details/details-payment.png') }}" alt="">
                                <ul>
                                    <li><span>SKU:</span> {{ $product->sku }}</li>
                                    <li><span>Categories:</span> {{ $product->category->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-description" role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-reviews" role="tab">Customer Reviews ({{ $product->reviews_count }})</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- Description Tab -->
                                <div class="tab-pane active" id="tabs-description" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p>{{ $product->detailed_description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Js Plugins -->
    <script src="{{ asset('js1/jquery.min.js') }}"></script>
    <script src="{{ asset('js1/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js1/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js1/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js1/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js1/main.js') }}"></script>
</body>

</html>