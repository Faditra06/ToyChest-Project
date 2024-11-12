<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ToyChest</title>
    <link rel="icon" href="images/ToyChest.svg">
    <link rel="stylesheet" href="{{ asset('css3/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css3/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/logreg_.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <base href="{{ url('/') }}/">
</head>

<body>
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <x-sidebar />
        <!-- Sidebar End -->
        <!-- Main wrapper -->
        <div class="body-wrapper">
            <!-- Header Start -->
            <x-header />
            <!-- Header End -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title fw-semibold mb-4">Products</h4>
                            <div class="mb-1 flex justify-between">
                                <!-- Add Category Button -->
                                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                    <i class="ti ti-circle-plus"></i> Add Product
                                </button>
                                <!-- Form Search -->
                                <form action="{{ route('product.search') }}" method="GET">
                                    <input type="text" name="search" class="form-input rounded-full border border-gray-900 focus:ring-primary focus:border-primary px-4 py-2" placeholder="Search by name" value="{{ request()->query('search') }}">
                                    <button type="submit" class="ml-2 px-4 py-2 bg-toychest2 text-white rounded-full hover:bg-toychest3 focus:outline-none focus:ring-2 focus:ring-toychest3">
                                        Search
                                    </button>
                                </form>
                                <!-- Form Sort By menggunakan Tailwind CSS -->
                                <form action="{{ route('product.search') }}" method="GET" class="relative inline-block">
                                    <div class="relative inline-block text-left">
                                        <button type="button" id="sortByButton" class="bg-toychest2 text-white font-semibold py-2 px-4 rounded-full inline-flex items-center">
                                            Sort By ▼
                                        </button>
                                        <ul id="sortByDropdown" class="absolute hidden text-gray-700 mt-2 w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                                            <li><a href="{{ route('product.search', ['sort' => 'newest']) }}" class="block px-4 py-2 hover:bg-gray-200">Newest</a></li>
                                            <li><a href="{{ route('product.search', ['sort' => 'oldest']) }}" class="block px-4 py-2 hover:bg-gray-200">Oldest</a></li>
                                            <li><a href="{{ route('product.search', ['sort' => 'name_asc']) }}" class="block px-4 py-2 hover:bg-gray-200">Name A-Z</a></li>
                                            <li><a href="{{ route('product.search', ['sort' => 'name_desc']) }}" class="block px-4 py-2 hover:bg-gray-200">Name Z-A</a></li>
                                        </ul>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Product Category</th>
                                        <th>Descripton</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="200" height="100">
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category ? $product->category->name : 'No Category' }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <!-- Edit Button triggers modal -->
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                                                Edit
                                            </button>

                                            <!-- Delete Form -->
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Edit Product Modal -->
                                    <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editProductModalLabel{{ $product->id }}">Edit Product</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="ProductName" class="form-label">Product Name</label>
                                                            <input type="text" class="form-control" id="ProductName" name="name" value="{{ $product->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="productDescription" class="form-label">Product Description</label>
                                                            <textarea class="form-control" id="productDescription" name="description">{{ $product->description }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="productCategory" class="form-label">Product Category</label>
                                                            <select class="form-select" id="productCategory" name="category_id">
                                                                <option value="">Select Category</option>
                                                                @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="productPrice" class="form-label">Product Price</label>
                                                            <input type="number" class="form-control" id="productPrice" name="price" value="{{ $product->price }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="productStock" class="form-label">Product Stock</label>
                                                            <input type="number" class="form-control" id="productStock" name="stock" value="{{ $product->stock }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="productImage" class="form-label">Product Image</label>
                                                            <input type="file" class="form-control" id="productImage" name="image">
                                                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="100" class="mt-2">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update Product</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No products found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="mb-3">
                            <label for="ProductName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="ProductName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Product Category</label>
                            <select class="form-select" id="productCategory" name="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Product Description</label>
                            <textarea class="form-control" id="productDescription" name="description" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="productPrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="productStock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="productStock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="productImage" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/dist/simplebar.js') }}"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <!-- dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortByButton = document.getElementById('sortByButton');
            const sortByDropdown = document.getElementById('sortByDropdown');

            // Toggle dropdown ketika tombol di klik
            sortByButton.addEventListener('click', function() {
                sortByDropdown.classList.toggle('hidden');
            });

            // Untuk menutup dropdown jika area luar diklik
            window.addEventListener('click', function(event) {
                if (!sortByButton.contains(event.target) && !sortByDropdown.contains(event.target)) {
                    sortByDropdown.classList.add('hidden');
                }
            });
        });
    </script>
</body>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

</html>