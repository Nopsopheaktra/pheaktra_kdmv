<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('branch_id', session('branch_id'))
            ->with('category')
            ->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_front' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'image_back' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Save images to storage/app/public/products
        if ($request->hasFile('image_front')) {
            $filename = time() . '_front_' . $request->file('image_front')->getClientOriginalName();
            $request->file('image_front')->storeAs('products', $filename, 'public');
            $data['image_front'] = $filename;
        }

        if ($request->hasFile('image_back')) {
            $filename = time() . '_back_' . $request->file('image_back')->getClientOriginalName();
            $request->file('image_back')->storeAs('products', $filename, 'public');
            $data['image_back'] = $filename;
        }

        $data['branch_id'] = session('branch_id') ?? 1;
        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_front' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'image_back' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image_front')) {
            $filename = time() . '_front_' . $request->file('image_front')->getClientOriginalName();
            $request->file('image_front')->storeAs('products', $filename, 'public');  // Fixed!
            $data['image_front'] = $filename;
        }

        if ($request->hasFile('image_back')) {
            $filename = time() . '_back_' . $request->file('image_back')->getClientOriginalName();
            $request->file('image_back')->storeAs('products', $filename, 'public');  // Fixed!
            $data['image_back'] = $filename;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }
    
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
