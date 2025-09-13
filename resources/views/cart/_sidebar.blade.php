<!-- Cart Header -->
<div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
    <h2 class="text-xl font-semibold text-gray-900">Shopping Cart</h2>
    <button @click="$dispatch('toggle-cart')"
            class="p-2 text-gray-400 hover:text-gray-600 transition-colors rounded-full hover:bg-gray-100">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

@php $cart = session()->get('cart', []); @endphp

@if (count($cart) > 0)
    <div class="flex-1 overflow-y-auto px-6 py-4">
        <div class="space-y-6">
            @foreach ($cart as $productId => $item)
                <div class="flex gap-4 items-start">
                    <div class="flex-shrink-0">
                        @if ($item['image_front'])
                            <img src="{{ asset('storage/products/' . $item['image_front']) }}"
                                 alt="{{ $item['name'] }}"
                                 class="w-20 h-20 object-cover rounded-lg border border-gray-200 shadow-sm">
                        @else
                            <div class="w-20 h-20 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center shadow-sm">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0 space-y-2">
                        <h3 class="text-base font-medium text-gray-900 leading-relaxed">{{ $item['name'] }}</h3>
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-600">Qty: {{ $item['quantity'] }}</span>
                            <span class="text-gray-300">•</span>
                            <span class="text-sm font-medium text-gray-900">${{ number_format($item['price'], 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between pt-1">
                            <span class="text-lg font-semibold text-gray-900">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </span>
                            <form action="{{ route('cart.remove', $productId) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-600 text-xs font-medium transition-colors">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="border-t border-gray-100 px-6 py-4 space-y-4">
        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <span class="text-base text-gray-600">Subtotal ({{ count($cart) }} {{ count($cart) === 1 ? 'item' : 'items' }})</span>
                <span class="text-base font-medium text-gray-900">
                    ${{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 2) }}
                </span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-base text-gray-600">Shipping</span>
                <span class="text-base text-gray-900">Free</span>
            </div>
            <div class="border-t border-gray-200 pt-3">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold text-gray-900">Total</span>
                    <span class="text-xl font-bold text-gray-900">
                        ${{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 2) }}
                    </span>
                </div>
            </div>
        </div>

        <p class="text-xs text-gray-500 text-center bg-gray-50 py-2 px-3 rounded-lg">
            Free shipping on all orders. Taxes calculated at checkout.
        </p>

        <div class="space-y-3">
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full bg-black text-white py-3 px-4 rounded-lg text-sm font-medium hover:bg-gray-800 transition-colors">
                    Proceed to Checkout
                </button>
            </form>

            {{-- <a href="{{ route('cart.index') }}"
               class="w-full bg-white text-black py-3 px-4 rounded-lg text-sm font-medium border border-gray-300 hover:bg-gray-50 hover:border-gray-400 transition-all text-center block">
                View Full Cart
            </a> --}}
        </div>

        <div class="pt-3">
            <button @click="$dispatch('toggle-cart')"
                    class="w-full text-sm text-gray-600 hover:text-gray-900 transition-colors py-2 underline underline-offset-4">
                ← Continue Shopping
            </button>
        </div>
    </div>
@else
    <div class="flex flex-col items-center justify-center flex-1 px-6 py-4 text-center">
        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l-1 12H6L5 9z">
                </path>
            </svg>
        </div>
        <h3 class="text-base font-medium text-gray-900 mb-2">Your cart is empty</h3>
        <p class="text-xs text-gray-500 mb-4 max-w-xs">
            Add some products to get started.
        </p>
        <button @click="$dispatch('toggle-cart')"
                class="bg-black text-white py-2 px-4 rounded-lg text-sm font-medium hover:bg-gray-800 transition-colors">
            Start Shopping
        </button>
    </div>
@endif
