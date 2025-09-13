<x-app-layout>
    <div class="min-h-screen bg-white py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold tracking-tight text-black uppercase">Products</h1>
                <div class="w-20 h-px bg-gray-300 mx-auto mt-4"></div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($products as $product)
                    <a href="{{ route('products.show', $product) }}" class="group">
                        <div class="bg-white border border-gray-100 rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300">
                            <!-- Product Image -->
                            <div class="aspect-square bg-gray-100 flex items-center justify-center">
                                @if($product->image_front)
                                    <img src="{{ asset('storage/products/' . $product->image_front) }}"
                                         alt="{{ $product->name }}"
                                         class="object-cover w-full h-full">
                                @else
                                    <span class="text-gray-400 text-sm">No Image</span>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="p-5 text-center">
                                <h3 class="text-lg font-semibold text-black mb-2 truncate">{{ $product->name }}</h3>
                                <p class="text-black font-medium text-xl">${{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
