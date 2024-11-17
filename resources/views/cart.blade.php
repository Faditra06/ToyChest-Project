<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <title>ToyChest</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css1/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css1/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css1/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css1/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css1/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css1/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css1/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css1/style.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/logreg_.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <!-- header section strats -->
    <x-app-layout>
    </x-app-layout>
    <!-- header section end -->
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cartItems->isEmpty())
                                <p>Your cart is empty.</p>
                                @else
                                @foreach ($cartItems as $item)
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic max-w-24">
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{ $item->product->name }}</h6>
                                            <h5>Rp {{ number_format($item->product->price, 0, ',', '.') }}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex">
                                            @csrf
                                            @method('PUT')
                                            <div class="quantity w-14">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="rounded-pill w-full">
                                            </div>
                                            <button type="submit" class="bg-transparent rounded-full text-toychest2 px-1 mt-2 ms-1 me-3"><i class="fa-solid fa-arrows-rotate"></i></button>
                                        </form>
                                    </td>
                                    <td class="cart__price">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                                    <td class="cart__close">
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('shop') }}" class="rounded-full">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#" class="bg-toychest2"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-4">
                    <div class="cart__total border rounded-2xl p-4">
                        <h6>Cart total</h6>
                        @if ($cartItems && $cartItems->isNotEmpty())
                        <ul>
                            <li>Subtotal
                                <span class="text-toychest2">
                                    Rp {{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }}
                                </span>
                            </li>
                            <li>Total
                                <span class="text-toychest2">
                                    Rp {{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }}
                                </span>
                            </li>
                        </ul>
                        <button type="button"
                            class="primary-btn border-0 rounded-pill bg-toychest1 hover:bg-toychest2 transition ease-in-out duration-300"
                            onclick="payNow()">
                            Proceed to checkout
                        </button>
                        @else
                        <p class="text-toychest2">Keranjang kosong. Tambahkan produk untuk melanjutkan ke checkout.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <x-footer />


    <!-- Js Plugins -->
    <script src="js1/jquery-3.3.1.min.js"></script>
    <script src="js1/bootstrap.min.js"></script>
    <script src="js1/jquery.nice-select.min.js"></script>
    <script src="js1/jquery.nicescroll.min.js"></script>
    <script src="js1/jquery.magnific-popup.min.js"></script>
    <script src="js1/jquery.countdown.min.js"></script>
    <script src="js1/jquery.slicknav.js"></script>
    <script src="js1/mixitup.min.js"></script>
    <script src="js1/owl.carousel.min.js"></script>
    <script src="js1/main.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-OYORG6IH9tP7qosd"></script>

    <script type="text/javascript">
        function payNow() {
            // Ambil snapToken dari API
            fetch('/checkout') // Panggil backend untuk mengambil snapToken
                .then(response => response.json())
                .then(data => {
                    var snapToken = data.snapToken; // Ambil snapToken dari response backend

                    // Gunakan Snap JS untuk transaksi
                    snap.pay(snapToken, {
                        onSuccess: function(result) {
                            alert("Pembayaran berhasil!");

                            // Langkah 3: Kirim permintaan untuk memeriksa status transaksi
                            fetch('/check-transaction-status', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        transactionId: result.transaction_id
                                    }) // Kirim transaction_id ke backend
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        console.log("Status transaksi berhasil diperbarui:", data);
                                        handleEmptyCart(); // Kosongkan cart setelah pembayaran sukses
                                    } else {
                                        console.error("Gagal memeriksa status transaksi:", data);
                                    }
                                })
                                .catch(error => {
                                    console.error('Terjadi kesalahan saat memeriksa status transaksi:', error);
                                });
                        },
                        onPending: function(result) {
                            alert("Pembayaran sedang diproses!");
                            handleEmptyCart();
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal. Silakan coba lagi.");
                        }
                    });
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat memproses pembayaran:', error);
                });
        }
    </script>

</body>

</html>