<x-app-layout>
    <div class="min-h-screen bg-white py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-light text-gray-900">Manage Products</h1>
                <a href="{{ route('admin.products.create') }}" class="bg-black text-white px-4 py-2 text-sm hover:bg-gray-800">
                    + Add Product
                </a>
            </div>

            <!-- Products Table -->
            <div class="bg-white border border-gray-100 rounded-none">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left p-4 font-normal text-sm text-gray-600">Name</th>
                            <th class="text-left p-4 font-normal text-sm text-gray-600">Price</th>
                            <th class="text-left p-4 font-normal text-sm text-gray-600">Stock</th>
                            <th class="text-left p-4 font-normal text-sm text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr class="border-b border-gray-100">
                            <td class="p-4">{{ $product->name }}</td>
                            <td class="p-4">${{ number_format($product->price, 2) }}</td>
                            <td class="p-4">{{ $product->stock }}</td>
                            <td class="p-4">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 text-sm mr-3">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this product?')" class="text-red-600 hover:text-red-800 text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
