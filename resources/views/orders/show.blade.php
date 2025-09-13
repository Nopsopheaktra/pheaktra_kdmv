<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('orders.index') }}"
           class="text-gray-500 hover:text-black text-sm font-light mb-6 inline-block">
            ← Back to Orders
        </a>

        <h1 class="text-3xl font-light mb-8">Order #{{ $sale->id }}</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-2 px-4 text-gray-600 text-sm">Product</th>
                        <th class="py-2 px-4 text-gray-600 text-sm">Quantity</th>
                        <th class="py-2 px-4 text-gray-600 text-sm">Price</th>
                        <th class="py-2 px-4 text-gray-600 text-sm">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($items as $item)
                        <tr>
                            <td class="py-3 px-4 text-gray-900">{{ $item->product->name ?? 'Deleted Product' }}</td>
                            <td class="py-3 px-4 text-gray-900">{{ $item->quantity }}</td>
                            <td class="py-3 px-4 text-gray-900">${{ number_format($item->price, 2) }}</td>
                            <td class="py-3 px-4 text-gray-900">${{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-end mt-6">
                <div class="text-right">
                    <p class="text-gray-600 text-sm">Total:</p>
                    <p class="text-gray-900 font-medium text-lg">${{ number_format($sale->total_amount, 2) }}</p>
                </div>
            </div>

            <div class="mt-4 text-right">
                <p class="text-sm text-gray-500">Status: <span class="{{ $sale->status === 'completed' ? 'text-green-600' : 'text-yellow-600' }}">{{ ucfirst($sale->status) }}</span></p>
            </div>
        </div>
    </div>
</x-app-layout>
