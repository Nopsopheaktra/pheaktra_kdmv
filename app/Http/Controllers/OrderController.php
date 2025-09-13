<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Sale::where('user_id', Auth::id())
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Sale $sale)
    {
        if ($sale->user_id !== Auth::id()) {
            abort(403);
        }

        $items = $sale->items()->with('product')->get();
        return view('orders.show', compact('sale', 'items'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

            $sale = Sale::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'completed',
            ]);

            foreach ($cart as $productId => $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                $product = Product::find($productId);
                if ($product) {
                    $product->decrement('stock', $item['quantity']);
                }
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('orders.show', $sale->id)->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to process order. Try again.');
        }
    }
}
