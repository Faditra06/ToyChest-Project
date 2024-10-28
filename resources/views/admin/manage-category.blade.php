<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ToyChest</title>
  <link rel="shortcut icon" href="images/favicon.ico" type=""> 
  <link rel="stylesheet" href="css3/styles.min.css" />
  <link rel="stylesheet" href="css3/custom.css" />
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
              <h4 class="card-title fw-semibold mb-4">Categories</h4>

              <!-- Add Category Button -->
              <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="ti ti-circle-plus"></i> Add Category
              </button>

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
                    @foreach($categories as $index => $category)
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
                    @endforeach
                  </tbody>
                </table>
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