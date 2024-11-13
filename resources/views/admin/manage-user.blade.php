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
          @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
          <div class="card">
            <div class="card-body">
              <h4 class="card-title fw-semibold mb-4">Users</h4>
              <div class="mb-4 flex justify-between">
                <!-- Form Search -->
                <form action="{{ route('admin.users.index') }}" method="GET">
                  <input type="text" name="search" class="form-input rounded-full border border-gray-900 focus:ring-primary focus:border-primary px-4 py-2" placeholder="Search by name" value="{{ request()->query('search') }}">
                  <button type="submit" class="ml-2 px-4 py-2 bg-toychest2 text-white rounded-full hover:bg-toychest3 focus:outline-none focus:ring-2 focus:ring-toychest3">
                    Search
                  </button>
                </form>
                <!-- Form Sort By menggunakan Tailwind CSS -->
                <form action="{{ route('admin.users.index') }}" method="GET" class="relative inline-block" id="sortForm">
                  <div class="relative inline-block text-left">
                    <button type="button" id="sortByButton" class="bg-toychest2 text-white font-semibold py-2 px-4 rounded-full inline-flex items-center">
                      Sort By ▼
                    </button>
                    <ul id="sortByDropdown" class="absolute hidden text-gray-700 mt-2 w-full bg-white border border-gray-300 rounded-lg shadow-lg">
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Register at</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  @forelse($users as $index => $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->number }}</td>
                    <td>
                      <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this account?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                      </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4" class="text-center">No users found</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              <!-- Kontrol pagination -->
              <div class="pagination mt-4 mb-3 flex justify-center">
                {{ $users->links() }}
              </div>
            </div>
          </div>
        </div>
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
    // Ambil elemen dropdown dan tombol
    const sortByButton = document.getElementById('sortByButton');
    const sortByDropdown = document.getElementById('sortByDropdown');
    const sortForm = document.getElementById('sortForm');

    // Toggle dropdown saat tombol diklik
    sortByButton.addEventListener('click', function() {
      sortByDropdown.classList.toggle('hidden');
    });

    // Tangani saat pengguna memilih opsi
    const options = sortByDropdown.querySelectorAll('a');
    options.forEach(option => {
      option.addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah link default behavior

        // Ambil nilai dari data-sort
        const sortValue = this.getAttribute('data-sort');

        // Set input atau parameter query
        const searchParams = new URLSearchParams(window.location.search);
        searchParams.set('sort_by', sortValue);

        // Update URL dan submit form
        window.location.search = searchParams.toString();
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