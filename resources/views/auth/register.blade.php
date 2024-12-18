<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToyChest</title>
    <link rel="icon" href="images/ToyChest.svg">
    <link rel="stylesheet" href="css/logreg_.css">
</head>

<body>
    <div class="login items-center justify-center h-screen place-content-center grid">
        <div class="place-content-center grid border border-black rounded-3xl px-10 shadow-xl">
            <a href="{{ url('/') }}" class="mx-auto mb-2">
                <img src="images/ToyChest.svg" alt="" class="max-w-28 fill-toychest2" />
            </a>
            <h1 class="text-3xl mx-auto font-semibold text-toychest2 mb-4">Sign up</h1>
            <div class="form w-full">
                <form method="POST" action="{{ route('register') }}" class="font-medium text-base text-toychest2 w-96 mb-3">
                    @csrf

                    @error('email')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="username"
                        class="border border-toychest2 rounded-2xl w-full py-2 px-5 mb-2 mt-1">

                    @error('name')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <label for="name">Username</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autocomplete="name"
                        class="border border-toychest2 rounded-2xl w-full py-2 px-5 mb-2 mt-1">

                    @error('number')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <label for="number">Phone Number</label>
                    <input type="text" name="number" id="number" value="{{ old('number') }}"
                        class="border border-toychest2 rounded-2xl w-full py-2 px-5 mb-2 mt-1">

                    @error('address')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}"
                        class="border border-toychest2 rounded-2xl w-full py-2 px-5 mb-2 mt-1">

                    @error('password')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required autocomplete="new-password"
                        class="border border-toychest2 rounded-2xl w-full py-2 px-5 mb-2 mt-1">

                    <button type="submit" class="bg-toychest2 text-slate-200 font-semibold text-sm text-center w-full py-3 rounded-2xl my-1">
                        {{ __('Register') }}
                    </button>
                    <p class="text-xs font-medium text-center text-gray-950">don't have an account yet? <a href="{{ route('login') }}"
                            class="text-toychest1">Sign In</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>