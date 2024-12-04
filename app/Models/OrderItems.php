<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = ['products_id', 'quantity', 'price', 'orders_id', 'carts_id'];

    /**
     * Get the product associated with the order item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    /**
     * Get the order associated with the order item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id');
    }

    /**
     * Get the cart associated with the order item.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'carts_id');
    }
}
