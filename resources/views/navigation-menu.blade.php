<nav x-data="{ open: false }" class="bg-toychest1">
    <!-- Primary Navigation Menu -->
    <div class="px-2 sm:px-4 lg:px-6">
        <div class="flex">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center ps-14 pb-1 pt-3">
                    <a href="{{ route('admin.home') }}" :active="request()->routeIs('dashboard')">
                        <img src="{{ asset('images/c3fd4904-5e2a-44ca-920e-0366a805ef65-transformed-removebg-preview.png') }}" alt="Logo" class="w-1/4">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="sm:-my-px sm:flex items-center">
                    <x-nav-link href="{{ route('admin.home') }}" :active="request()->routeIs('dashboard')" class="text-white uppercase mx-2">
                        Home
                    </x-nav-link>
                    <x-nav-link href="#about" class="text-white uppercase mx-2">
                        About
                    </x-nav-link>
                    <x-nav-link href="{{ route('shop') }}" class="text-white uppercase mx-2">
                        Shop
                    </x-nav-link>
                    <x-nav-link href="{{ route('contact') }}" class="text-white uppercase mx-1">
                        Contact
                    </x-nav-link>
                    <x-nav-link href="{{ route('cart') }}" class="text-white uppercase ms-2">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </x-nav-link>
                    <form class="form-inline">
                        <button class="btn mx-1 my-2 my-sm-0 nav_search-btn" type="submit">
                            <i class="fa fa-search text-white" aria-hidden="true"></i>
                        </button>
                    </form>
                    <x-dropdown >
                        <x-slot name="trigger">
                            <button class="flex items-center px-3 py-2 border-transparent text-md leading-4 font-sm rounded-full text-white bg-toychest2 hover:bg-toychest3 focus:outline-none focus:bg-toychest3 active:bg-toychest3 transition ease-in-out duration-150">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="ml-2 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Profile Link -->
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>