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
          @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
          <div class="card">
            <div class="card-body">
              <h4 class="card-title fw-semibold mb-4">Categories</h4>
              <div class="mb-1 flex justify-between">
                <!-- Add Category Button -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                  <i class="ti ti-circle-plus"></i> Add Category
                </button>
                <!-- Form Search -->
                <form action="{{ route('admin.category.ss') }}" method="GET">
                  <input type="text" name="search" class="form-input rounded-full border border-gray-900 focus:ring-primary focus:border-primary px-4 py-2" placeholder="Search by name" value="{{ request()->query('search') }}">
                  <button type="submit" class="ml-2 px-4 py-2 bg-toychest2 text-white rounded-full hover:bg-toychest3 focus:outline-none focus:ring-2 focus:ring-toychest3">
                    Search
                  </button>
                </form>
                <!-- Form Sort By menggunakan Tailwind CSS -->
                <form action="{{ route('admin.category.ss') }}" method="GET" class="relative inline-block" id="categorySortForm">
                  <div class="relative inline-block text-left">
                    <button type="button" id="sortByCategoryButton" class="bg-toychest2 text-white font-semibold py-2 px-4 rounded-full inline-flex items-center">
                      Sort By ▼
                    </button>
                    <ul id="sortByCategoryDropdown" class="absolute hidden text-gray-700 mt-2 w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                      <li><a href="#" data-sort="newest" class="block px-4 py-2 hover:bg-gray-200">Newest</a></li>
                      <li><a href="#" data-sort="oldest" class="block px-4 py-2 hover:bg-gray-200">Oldest</a></li>
                      <li><a href="#" data-sort="name_asc" class="block px-4 py-2 hover:bg-gray-200">Name A-Z</a></li>
                      <li><a href="#" data-sort="name_desc" class="block px-4 py-2 hover:bg-gray-200">Name Z-A</a></li>
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
                    <th>Category Name</th>
                    <th>Parent Category</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  @forelse($categories as $index => $category)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent ? $category->parent->name : 'None' }}</td>
                    <td>
                      <!-- Edit Button triggers modal -->
                      <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">
                        Edit
                      </button>

                      <!-- Delete Form -->
                      <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure to delete this category?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                      </form>
                    </td>
                  </tr>

                  <!-- Edit Category Modal -->
                  <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Edit Category</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                              <label for="categoryName" class="form-label">Category Name</label>
                              <input type="text" class="form-control" id="categoryName" name="name" value="{{ $category->name }}" required>
                            </div>
                            <div class="mb-3">
                              <label for="parentCategory" class="form-label">Parent Category</label>
                              <select class="form-select" id="parentCategory" name="parent_id">
                                <option value="">None</option>
                                @foreach($categories as $parentCategory)
                                <option value="{{ $parentCategory->id }}" {{ $category->parent_id == $parentCategory->id ? 'selected' : '' }}>
                                  {{ $parentCategory->name }}
                                </option>
                                @endforeach
                              </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Category</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  @empty
                  <tr>
                    <td colspan="4" class="text-center">No categories found</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              <!-- Kontrol pagination -->
              <div class="pagination mt-4 mb-3 flex justify-center">
                {{ $categories->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Category Modal -->
  <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="categoryName" class="form-label">Category Name</label>
              <input type="text" class="form-control" id="categoryName" name="name" required>
            </div>
            <div class="mb-3">
              <label for="parentCategory" class="form-label">Parent Category</label>
              <select class="form-select" id="parentCategory" name="parent_id">
                <option value="">None</option>
                @foreach($categories as $parentCategory)
                <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
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
      // Menangani dropdown untuk kategori
      const sortByCategoryButton = document.getElementById('sortByCategoryButton');
      const sortByCategoryDropdown = document.getElementById('sortByCategoryDropdown');
      const categorySortForm = document.getElementById('categorySortForm');

      sortByCategoryButton.addEventListener('click', function() {
        sortByCategoryDropdown.classList.toggle('hidden');
      });

      const categoryOptions = sortByCategoryDropdown.querySelectorAll('a');
      categoryOptions.forEach(option => {
        option.addEventListener('click', function(e) {
          e.preventDefault();
          const sortValue = this.getAttribute('data-sort');
          const searchParams = new URLSearchParams(window.location.search);
          searchParams.set('sort_by', sortValue);
          window.location.search = searchParams.toString();
        });
      });
    });
  </script>
</body>

</html>