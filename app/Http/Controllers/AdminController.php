<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImages;
class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::all();
        $categories = Category::all(); // Fetch categories
        return view('admin.dashboard', compact('products', 'categories'));
    }
}
