<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ToyCHest</title>
  <link rel="shortcut icon" href="images/favicon.ico" type="">
  <link rel="stylesheet" href="css3/styles.min.css" />
  <link rel="stylesheet" href="css3/custom.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <x-sidebar />
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <x-header />
      <!--  Header End -->
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title fw-semibold mb-4">Category</h4>
              <ul>
                @foreach ($categories as $category)
                <li>
                  {{ $category->name }}
                  @if($category->children->isNotEmpty())
                  <ul>
                    @foreach ($category->children as $child)
                    <li>{{ $child->name }}</li>
                    @endforeach
                  </ul>
                  @endif
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="libs/jquery/dist/jquery.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/sidebarmenu.js"></script>
  <script src="js/app.min.js"></script>
  <script src="libs/simplebar/dist/simplebar.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

</html>