<nav x-data="{ open: false, dropdown: false }" class="bg-gray-200 border-b border-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-black" />
                    </a>
                </div>
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="flex items-center space-x-8">
                @auth
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-black hover:text-gray-700" :class="request()->routeIs('dashboard') ? 'border-b-2 border-black' : ''">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" class="text-black hover:text-gray-700" :class="request()->routeIs('products.index') ? 'border-b-2 border-black' : ''">
                        {{ __('Products') }}
                    </x-nav-link>
                @endauth
                @guest
                    <x-nav-link :href="route('login')" class="text-black hover:text-gray-700">
                        {{ __('Log In') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')" class="text-black hover:text-gray-700">
                        {{ __('Sign Up') }}
                    </x-nav-link>
                @else
                    <!-- Fixed Cart Button -->
                    <button @click="$dispatch('toggle-cart')"
                            class="text-black hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                        {{ __('Cart') }}
                    </button>
                @endauth
                @auth
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.products.index')" :active="request()->is('admin*')" class="text-black hover:text-gray-700" :class="request()->is('admin*') ? 'border-b-2 border-black' : ''">
                            {{ __('Admin') }}
                        </x-nav-link>
                    @endif
                @endauth
                <div class="relative" x-data="{ open: false }">
                    @auth
                        <button @click="open = !open" class="text-lg font-medium text-black hover:text-gray-700 focus:outline-none">
                            Welcome, {{ Auth::user()->username }}
                            <svg class="ml-1 inline h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @else
                        <span class="text-lg font-medium text-black">Welcome, Guest</span>
                    @endauth
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                        <x-dropdown-link :href="route('profile.edit')" class="block px-4 py-2 text-sm text-black hover:bg-gray-100">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-black hover:bg-gray-100 text-left">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-black hover:text-gray-900 hover:bg-gray-300 focus:outline-none focus:bg-gray-300 focus:text-gray-900 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-black hover:bg-gray-200" :class="request()->routeIs('dashboard') ? 'border-b-2 border-black' : ''">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" class="text-black hover:bg-gray-200" :class="request()->routeIs('products.index') ? 'border-b-2 border-black' : ''">
                    {{ __('Products') }}
                </x-responsive-nav-link>
            @endauth
            @guest
                <x-responsive-nav-link :href="route('login')" class="text-black hover:bg-gray-200">
                    {{ __('Log In') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" class="text-black hover:bg-gray-200">
                    {{ __('Sign Up') }}
                </x-responsive-nav-link>
            @else
                <!-- Fixed Mobile Cart Button -->
                <button @click="$dispatch('toggle-cart')"
                        class="block w-full text-left px-4 py-2 text-black hover:bg-gray-200 focus:outline-none transition duration-150 ease-in-out">
                    {{ __('Cart') }}
                </button>
            @endauth
            @auth
                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->is('admin*')" class="text-black hover:bg-gray-200" :class="request()->is('admin*') ? 'border-b-2 border-black' : ''">
                        {{ __('Admin') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
            <x-responsive-nav-link :href="route('profile.edit')" class="text-black hover:bg-gray-200">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}" @submit.prevent>
                @csrf
                <button type="submit" class="block w-full px-4 py-2 text-sm text-black hover:bg-gray-200 text-left">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</nav>
