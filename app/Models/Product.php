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
        'desc',
        'category_id'
    ];
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
