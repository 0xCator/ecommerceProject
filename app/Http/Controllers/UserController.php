<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\OrderItems;

class UserController extends Controller
{
    // Display user dashboard with products and category sidebar
    public function dashboard(Request $request)
    {
        $query = Product::with('multiimages'); 
    
        if ($request->has('id')) {
            $query->where('category_id', $request->id);
        }
    
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
    
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
    
        $products = $query->get();
        $categories = Category::all();
    
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $orderItems = $cart->orderitems;
    
        return view('user.dashboard', compact('products', 'categories', 'cart', 'orderItems'));
    }    
    public function displayCart(CartController $cartController)
    {
        return $cartController->displayCart();
    }
    public function displayOrders(OrderController $orderController)
    {
        return $orderController->displayOrders();
    }
    // Add product to cart
    public function addToCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($request->product_id);

    if ($product->stock < $request->quantity) {
        return redirect()->back()->withErrors(['error' => 'Insufficient stock for the selected product.']);
    }

    $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

    // Check if the product already exists in the cart
    $orderItem = OrderItems::where('products_id', $product->id)
        ->where('carts_id', $cart->id)
        ->first();

    if ($orderItem) {
        // Update the quantity and price
        $orderItem->quantity += $request->quantity;
        $orderItem->price = $product->price * $orderItem->quantity;
        $orderItem->save();
    } else {
        // Create a new order item
        $orderItem = new OrderItems([
            'products_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->price * $request->quantity,
            'carts_id' => $cart->id,
        ]);
        $orderItem->save();
    }

    // Deduct the stock
    // $product->decrement('stock', $request->quantity);

    return redirect()->back()->with('success', 'Product added to cart successfully!');
}

}

