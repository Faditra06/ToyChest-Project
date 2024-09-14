<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToyChest</title>
    <link rel="stylesheet" href="css/logreg_.css">
</head>

<body>
<x-validation-errors class="mb-4" />
    <div class=" md:mx-0 grid grid-cols-2">
        <div class="login relative">
            <div class="grid place-items-center h-screen w-screen lg:w-full">
                <a href="index.html">
                    <img src="images/android-chrome-512x512.png" class="size-16">
                </a>
                <h1 class="text-2xl font-semibold text-cyan-600">Sign Up</h1>
                <div class="form w-10/12 lg:w-6/12">
                    <form method="POST" action="{{ route('register') }}" class="font-medium text-base text-cyan-600">
                        @csrf
                        <label for="email" value="{{ __('Email') }}">Email</label>
                        <input type="email" name="email" id="email" :value="old('email')" required autocomplete="username"
                            class="border border-cyan-950 rounded-2xl w-full py-2 px-5 mb-3 mt-1 ">
                        <label for="name" value="{{ __('Name') }}">Username</label>
                        <input type="text" name="name" id="name" :value="old('name')" required autofocus autocomplete="name"
                            class="border border-cyan-950 rounded-2xl w-full py-2 px-5 mb-3 mt-1 ">
                        <label for="number" value="{{ __('Phone Number') }}">Phone Number</label>
                        <input type="text" name="number" id="number" value="{{ old('phone') }}"
                            class="border border-cyan-950 rounded-2xl w-full py-2 px-5 mb-3 mt-1 ">
                        <label for="address" value="{{ __('Address') }}">Address</label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}"
                            class="border border-cyan-950 rounded-2xl w-full py-2 px-5 mb-3 mt-1 ">
                        <label for="password" value="{{ __('Password') }}">Password</label>
                        <input type="password" name="password" id="password" required autocomplete="new-password"
                            class="border border-cyan-950 rounded-2xl w-full py-2 px-5 mt-1">
                        <button type="submit" class="bg-blue-950 text-slate-200 font-semibold text-sm text-center w-full py-3 rounded-2xl my-1">
                        {{ __('Register') }}
                        </button>
                        <p class="text-xs font-medium text-center text-gray-950">don't have an account yet? <a href="{{ route('login') }}"
                                class="text-cyan-600">Sign In</a></p>
                    </form>
                </div>
            </div>
        </div>
        <div class="gambar relative hidden lg:block h-screen">
            <div class="carousel-item active relative w-full h-screen">
                <img src="images/jason-leung-M55JcA9wOG0-unsplash.jpg" class="w-full object-cover h-full brightness-75" alt="Image 1">
                <div class="items-center absolute inset-0 grid place-items-center justify-center">
                    <div class="w-1/2">
                        <h1 class="text-white text-6xl font-bold">Bringin Joy to Every Playtime</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>