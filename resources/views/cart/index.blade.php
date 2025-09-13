<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black">
                    <h2 class="text-2xl font-bold">Your Cart</h2>
                    <p class="mt-4">Your cart items are displayed in the sidebar on the right. Use the checkout option when ready.</p>
                    @if (session()->get('cart', []) > 0)
                        <a href="{{ route('products.index') }}" class="block text-center text-blue-600 hover:text-blue-800 mt-6">
                            Continue Shopping
                        </a>
                    @else
                        <p class="text-gray-500 text-center mt-4">Your cart is empty.</p>
                        <a href="{{ route('products.index') }}" class="block text-center text-blue-600 hover:text-blue-800 mt-4">
                            Continue Shopping
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
