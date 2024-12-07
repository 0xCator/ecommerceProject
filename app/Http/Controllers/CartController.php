<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cart;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\Order;

class CartController extends Controller
{
    // Display Cart Dashboard
    public function dashboard()
    {
        $cart = Cart::where('user_id', auth()->id())->first();
 
        if ($cart) {
            $orderItems = $cart->orderItems()->with('product')->get();
        } else {
            $orderItems = []; // Ensure it's an array if no cart exists
        }
    
        return view('user.cart-panel', compact('orderItems'));
    }
    

    // Update Cart Item
    public function update(Request $request, $id)
    {
        $orderItem = OrderItems::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = $orderItem->product;

        if ($product->stock < $request->quantity) {
            return redirect()->back()->withErrors(['error' => 'Insufficient stock for the selected product.']);
        }

        // Update quantity and price
        $orderItem->quantity = $request->quantity;
        $orderItem->price = $product->price * $request->quantity;
        $orderItem->save();
        return Redirect::to('/user/cart')->with('success', 'Cart item updated successfully!');
    }

    // Remove Cart Item
    public function remove($id)
    {
        $orderItem = OrderItems::findOrFail($id);

        // Restore stock
        $orderItem->product->increment('stock', $orderItem->quantity);

        $orderItem->delete();

        return Redirect::to('/user/cart')->with('success', 'Cart item updated successfully!');
    }

    // Place Order
    public function placeOrder()
    {
        /* $cart = Cart::where('user_id', auth()->id())->first();
    
        if (!$cart || $cart->orderItems->isEmpty()) {
            return redirect()->route('user.dashboard')->withErrors(['error' => 'Your cart is empty.']);
        }
    
        // Create a new order
        $order = Order::firstOrCreate(['user_id' => auth()->id()]);
        
    
        // Update order items
        foreach ($cart->orderItems as $cartItem) {
            $orderItem = new OrderItems;
            $orderItem->product_id = $cartItem->product_id;
            $orderItem->quantity = $cartItem->quantity;
            $orderItem->price = $cartItem->price;
            $orderItem->order_id = $order->id;
            $orderItem->cart_id = null;
            $orderItem->save();
        }
    
        // Clear the cart
        $cart->orderItems()->delete();
        $cart->delete();
     */
        return Redirect::to('/user/dashboard')->with('success', 'Cart item updated successfully!');
    }
}
