<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToyChest</title>
    <link rel="icon" href="images/ToyChest.svg">
    <link rel="stylesheet" href="css/logreg_.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        /* Custom styles for SweetAlert popup */
        .custom-popup {
            font-family: 'Arial', sans-serif;
            padding: 30px;
            border-radius: 20px;
            /* Border lebih melengkung */
            background-color: #f0f4f8;
            /* Ganti dengan warna background serupa halaman login */
        }

        .custom-title {
            font-size: 1.5rem;
            color: #2d3748;
            /* Warna yang sesuai dengan gaya Toychest */
        }

        .custom-confirm-button {
            background-color: #203247 !important;
            /* Sesuaikan warna tombol */
            color: white !important;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 20px;
            /* Lebih melengkung */
            transition: background-color 0.3s ease;
        }

        .custom-confirm-button:hover {
            background-color: #080d12 !important;
            /* Warna tombol saat hover */
        }
    </style>

</head>

<body>
    @if(session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif

    @if(session('message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Peringatan',
                text: "{{ session('message') }}",
                imageUrl: 'images/mingcute--warning-line.svg', // Ganti dengan URL ikon SVG/PNG kustom
                imageWidth: 100,
                imageHeight: 100,
                confirmButtonText: 'OK',
                buttonsStyling: false,
                customClass: {
                    popup: 'custom-popup',
                    title: 'custom-title',
                    confirmButton: 'custom-confirm-button',
                },
                background: '#f0f4f8',
                backdrop: 'rgba(0,0,0,0.4)',
            });
        });
    </script>
    @endif


    <div class="login items-center justify-center h-screen place-content-center grid">
        <div class="place-content-center grid border border-black rounded-3xl px-10 shadow-xl">
            <a href="{{ url('/') }}" class="mx-auto mb-3">
                <img src="images/ToyChest.svg" alt="" class="max-w-28 fill-toychest2" />
            </a>
            <h1 class="text-3xl mx-auto font-semibold text-toychest2 mb-6">Sign In</h1>
            <div class="form w-full">
                <form method="POST" action="{{ route('login') }}" class="font-medium text-base text-toychest2 w-96 mb-3">
                    @csrf
                    @error('email')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <label for="email" value="{{ __('Email') }}">Email</label>
                    <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username" id="email"
                        class="border border-toychest2 rounded-2xl w-full py-2 px-5 mb-3 mt-1 ">
                    @error('password')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <label for="password" value="{{ __('Password') }}">Password</label>
                    <input type="password" name="password" required autocomplete="current-password" id="password"
                        class="border border-toychest2 rounded-2xl w-full py-2 px-5 mt-1">
                    <!-- <a href="" class="font-medium text-sm text-cyan-600 float-right my-2">Forgot Password?</a> -->
                    @if (Route::has('password.request'))
                    <a class="font-medium text-sm text-toychest1 float-right my-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                    <!-- <button type="submit"
                            class="bg-blue-950 text-slate-200 font-semibold text-sm text-center w-full py-3 rounded-2xl my-1">Sign
                            In</button> -->
                    <button type="submit" class="bg-toychest2 text-slate-200 font-semibold text-sm text-center w-full py-3 rounded-2xl my-1">
                        {{ __('Log in') }}
                    </button>
                    <p class="text-xs font-medium text-center text-gray-800">don't have an account yet? <a href="{{ route('register') }}"
                            class="text-toychest1">Sign Up</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>