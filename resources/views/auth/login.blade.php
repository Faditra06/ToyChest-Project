<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToyChest</title>
    <link rel="stylesheet" href="css/logreg_.css">
</head>

<body>
    @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
    @endsession
    <div class=" md:mx-0 grid grid-cols-2">
        <div class="login relative">
            <div class="grid place-items-center h-screen w-screen lg:w-full xl:py-28 lg:py-96">
                <a href="index.html">
                    <img src="images/android-chrome-512x512.png" class="size-16">
                </a>
                <h1 class="text-2xl font-semibold text-cyan-600">Sign In</h1>
                <div class="form w-10/12 lg:w-6/12">
                    <form method="POST" action="{{ route('login') }}" class="font-medium text-base text-cyan-600">
                        @csrf
                        <label for="email" value="{{ __('Email') }}">Email</label>
                        <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username" id="email"
                            class="border border-cyan-950 rounded-2xl w-full py-2 px-5 mb-3 mt-1 ">
                        <label for="password" value="{{ __('Password') }}">Password</label>
                        <input type="password" name="password" required autocomplete="current-password" id="password"
                            class="border border-cyan-950 rounded-2xl w-full py-2 px-5 mt-1">
                        <!-- <a href="" class="font-medium text-sm text-cyan-600 float-right my-2">Forgot Password?</a> -->
                        @if (Route::has('password.request'))
                            <a class="font-medium text-sm text-cyan-600 float-right my-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        <!-- <button type="submit"
                            class="bg-blue-950 text-slate-200 font-semibold text-sm text-center w-full py-3 rounded-2xl my-1">Sign
                            In</button> -->
                        <button type="submit" class="bg-blue-950 text-slate-200 font-semibold text-sm text-center w-full py-3 rounded-2xl my-1">
                        {{ __('Log in') }}
                        </button>
                        <p class="text-xs font-medium text-center text-gray-800">don't have an account yet? <a href="{{ route('register') }}"
                                class="text-cyan-600">Sign Up</a></p>
                    </form>
                </div>
            </div>
        </div>
        <div class="gambar relative hidden lg:block h-screen">
            <div class="carousel-item active relative w-full h-screen">
                <img src="images/markus-spiske-OO89_95aUC0-unsplash (1).jpg" class="w-full object-cover h-full brightness-75" alt="Image 1">
                <div class="items-center absolute inset-0 grid place-items-center justify-center">
                    <div class="w-1/2">
                        <h1 class="text-white text-6xl font-bold">Welcome to a World of Fun!</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>