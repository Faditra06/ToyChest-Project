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
    <link rel="stylesheet" href="{{ asset('css/logreg_.css') }}" />
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
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
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
                                <form action="{{ route('cart.mashok') }}" method="POST" class="flex justify-self-center">
                                    @csrf
                                    <div class="quantity w-14">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" class="rounded-pill w-full"> <!-- Mengirimkan ID produk -->
                                        <input type="number" name="quantity" value="1" min="1" class="rounded-pill w-full">
                                    </div>
                                    <button type="submit" class="ms-3">Buy</button>
                                </form>
                            </div>
                            <div class="product__details__btns__option">
                                <form action="{{ route('cart.store') }}" method="POST" class="flex justify-self-center">
                                    @csrf
                                    <div class="quantity w-14">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" class="rounded-pill w-full"> <!-- Mengirimkan ID produk -->
                                        <input type="number" name="quantity" value="1" min="1" class="rounded-pill w-full">
                                    </div>
                                    <button type="submit" class="ms-3">Add to Cart</button>
                                </form>
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
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-OYORG6IH9tP7qosd"></script>

    <script type="text/javascript">
        function payNow() {
            // Ambil snapToken dari API
            fetch('/checkout')
                .then(response => response.json())
                .then(data => {
                    var snapToken = data.snapToken; // Pastikan snapToken ada di response JSON

                    // Gunakan Midtrans Snap API untuk memulai transaksi
                    snap.pay(snapToken, {
                        onSuccess: function(result) {
                            // Tampilkan hasil transaksi berhasil
                            alert("Pembayaran berhasil!");
                            window.location.href = "/success"; // Redirect ke halaman sukses
                        },
                        onPending: function(result) {
                            // Tampilkan hasil transaksi pending
                            alert("Pembayaran menunggu konfirmasi!");
                            window.location.href = "/pending"; // Redirect ke halaman pending
                        },
                        onError: function(result) {
                            // Tampilkan hasil transaksi gagal
                            alert("Pembayaran gagal!");
                            window.location.href = "/failed"; // Redirect ke halaman gagal
                        }
                    });
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('form[action="{{ route('cart.store') }}"]').forEach(form => {
                form.addEventListener('submit', async (event) => {
                    event.preventDefault(); // Mencegah reload halaman

                    const formData = new FormData(form);
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });

                        if (!response.ok) {
                            const errorData = await response.json();
                            console.error('Error:', errorData.error);
                            alert(errorData.error);
                            return;
                        }

                        const data = await response.json();
                        updateCartIcon(data.cartCount); // Memperbarui ikon cart
                    } catch (error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        // Fungsi untuk memperbarui ikon cart
        function updateCartIcon(cartCount) {
            const cartBadge = document.getElementById('cart-badge');
            if (cartBadge) {
                cartBadge.textContent = cartCount;
                cartBadge.style.display = cartCount > 0 ? 'block' : 'none';
            }
        }
    </script>
</body>

</html>