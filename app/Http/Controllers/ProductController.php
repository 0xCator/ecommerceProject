<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImages;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|integer',
                'stock' => 'required|integer',
                'description' => 'required|string',
                'category_id' => 'required|integer|exists:categories,id',
                'image.*' => 'nullable|required|image|mimes:png,webp'
            ]);

            $products = Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id')
            ]);
            $images = $request->file('images');
            foreach($images as $image){
                $image_name=date('YmDHi').$image->getClientOriginalName();
                $image->move(public_path('upload/products'),$image_name);
                MultiImages::create([
                    'name'=>$image_name,
                    'product_id'=>$products->id
                ]);
            }
            return redirect()->route('admin.dashboard')->with('success', 'Product created successfully.');
        }
        return view('admin.products.add-product');
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id); // Find product or return 404
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'images.*' => 'nullable|image|mimes:png,webp,jpeg|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:multi_images,id',
        ]);

        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
        ]);

        // image deletion
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = MultiImages::findOrFail($imageId);
                $imagePath = public_path('upload/products/' . $image->name);
                if (file_exists($imagePath)) {
                    unlink($imagePath); 
                }
                $image->delete(); 
            }
        }

        // new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = date('YmdHis') . '_' . $image->getClientOriginalName();
                $image->move(public_path('upload/products'), $imageName);

                MultiImages::create([
                    'name' => $imageName,
                    'product_id' => $product->id,
                ]);
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id); // Find the product or throw a 404 error
        $product->delete(); // Delete the product

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }
}
