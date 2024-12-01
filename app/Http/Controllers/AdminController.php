<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminController extends Controller
{
    // Admin Dashboard
    public function index()
    {
        $categories = Category::all();
        return view('admin.dashboard', compact('categories'));
    }

    // Show Form to Create a New Category
    public function createCategory()
    {
        return view('admin.create-category');
    }

    // Store the New Category
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Category created successfully.');
    }
}
