<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Dashboard Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-light text-gray-900">Dashboard</h1>
                <p class="text-gray-600 mt-1">Welcome back, {{ Auth::user()->username }}!</p>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Total Orders -->
                <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $totalOrders }}</p>
                </div>

                <!-- Total Sales -->
                <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                    <p class="text-sm text-gray-500">Total Sales</p>
                    <p class="mt-2 text-2xl font-semibold text-gray-900">${{ number_format($totalSales, 2) }}</p>
                </div>

                <!-- Pending Orders -->
                <div class="bg-white shadow rounded-lg p-6 flex flex-col">
                    <p class="text-sm text-gray-500">Pending Orders</p>
                    <p class="mt-2 text-2xl font-semibold text-yellow-600">{{ $pendingOrders }}</p>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-medium text-gray-900">Recent Orders</h2>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        <div class="p-6 flex justify-between items-center {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
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
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            You have no recent orders.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
