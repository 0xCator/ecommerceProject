<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\OrderItems;

class UserController extends Controller
{
    // Display user dashboard with products and category sidebar
    public function dashboard(Request $request)
    {
        $products = Product::query();

        // Filter by category ID if provided
        if ($request->has('id')) {
            $products->where('category_id', $request->id);
        }

        // Filter by price range if provided
        if ($request->has('min') && $request->has('max')) {
            $products->whereBetween('price', [$request->min, $request->max]);
        }

        // Fetch all products if no filters
        $products = $products->get();

        // Fetch all categories for the sidebar
        $categories = Product::select('category_id')->distinct()->get();

        return view('user.dashboard', compact('products', 'categories'));
    }

    // Add product to cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check stock availability
        if ($product->stock < $request->quantity) {
            return redirect()->back()->withErrors(['error' => 'Insufficient stock for the selected product.']);
        }

        // Fetch the user's cart or create a new one
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        // Add item to the cart
        OrderItems::create([
            'products_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->price * $request->quantity,
            'carts_id' => $cart->id,
        ]);

        // Decrement stock
        $product->decrement('stock', $request->quantity);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
}
