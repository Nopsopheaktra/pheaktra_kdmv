<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-light mb-8">My Orders</h1>

        @if(session('success'))
            <div class="bg-green-50 text-green-800 px-6 py-4 mb-6 text-sm font-light">
                {{ session('success') }}
            </div>
        @endif

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white shadow rounded-lg p-6 flex justify-between items-center">
                        <div>
                            <p class="text-gray-600 text-sm">Order #{{ $order->id }} - {{ $order->created_at->format('M d, Y') }}</p>
                            <p class="text-gray-900 font-medium text-lg">${{ number_format($order->total_amount, 2) }}</p>
                            <p class="text-sm {{ $order->status === 'completed' ? 'text-green-600' : 'text-yellow-600' }}">
                                {{ ucfirst($order->status) }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('orders.show', $order->id) }}"
                               class="bg-black text-white py-2 px-4 rounded-lg text-sm font-light hover:bg-gray-900 transition-colors">
                                View Order
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center mt-12">You have no orders yet.</p>
        @endif
    </div>
</x-app-layout>
