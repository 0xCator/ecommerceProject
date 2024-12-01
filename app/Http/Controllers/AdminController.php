<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::all();
        $categories = Category::all(); // Fetch categories
        return view('admin.dashboard', compact('products', 'categories'));
    }

    public function addProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|integer',
                'stock' => 'required|integer',
                'description' => 'required|string',
                'category_id' => 'required|integer|exists:categories,id'
            ]);

            Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id')
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Product created successfully.');
        }

        return view('admin.products.add-product');
    }
    public function editProduct($id)
    {
        $product = Product::findOrFail($id); // Find product or return 404
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id'
        ]);

        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully.');
    }
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id); // Find the product or throw a 404 error
        $product->delete(); // Delete the product

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }
    public function createCategory(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            Category::create(['name' => $request->input('name')]);

            return redirect()->route('admin.dashboard')->with('success', 'Category created successfully.');
        }

        return view('admin.categories.create');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate(['name' => 'required|string|max:255']);

        $category->update(['name' => $request->input('name')]);

        return redirect()->route('admin.dashboard')->with('success', 'Category updated successfully.');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Category deleted successfully.');
    }
}
