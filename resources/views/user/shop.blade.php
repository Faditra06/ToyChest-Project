<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

  <title> ToyChest </title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />

  <!-- Fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!-- Owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- Font Awesome style -->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

  <!-- Responsive style -->
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/logreg_.css') }}" />
</head>

<body class="sub_page">

  <!-- header section strats -->
  <x-app-layout>
  </x-app-layout>
  <!-- header section end -->

  <!-- shop section -->

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Products
        </h2>
      </div>
      <div class="row mx-20">
        @foreach($randomProducts as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{ route('detail', ['id' => $product->id]) }}">
              <div class="img-box">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
              </div>
              <div class="detail-box">
                <a href="{{ route('detail', ['id' => $product->id]) }}">
                  {{ $product->name }}
                </a>
                <h6>
                  Rp {{ number_format($product->price, 0, ',', '.') }}
                </h6>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>

      <div class="btn-box">
        <a href="{{ route('shop') }}" class="rounded-pill">
          View All Products
        </a>
      </div>
    </div>
  </section>

  <!-- end shop section -->

  <x-footer />

  <!-- jQery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>

</html>