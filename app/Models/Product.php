<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',    
        'stock',
        'description',
        'category_id'
    ];
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
    public function multiimages()
    {
        return $this->hasMany(MultiImages::class);
    }
    public function orderitems()
    {
        return $this->hasMany(OrderItems::class);
    }   
}