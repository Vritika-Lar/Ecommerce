<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('id', 'desc')->get();
    
        // MUST exist
        $cats = Category::get(['id', 'name']);

        return view('admin.products.index', compact('product', 'cats'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // IMAGE UPLOAD
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/products'), $imageName);

        // STORE PRODUCT
        Product::create([
            'category_id' => $request->category_id, // ✅ FIXED
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
            'is_featured' => $request->has('is_featured'),

            'image' => $imageName
        ]);
        // return($produt);
        return redirect()->back()->with('success', 'Product added successfully');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $cats = Category::get(['id', 'name']);
        return view('admin.products.edit', compact('product', 'cats'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $imageName = $product->image;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        // ✅ UNIQUE SLUG LOGIC
        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $count = 1;

        while (
            Product::where('slug', $slug)
                ->where('id', '!=', $product->id)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'is_featured' => $request->has('is_featured'),
            'image' => $imageName,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }

    public function liveSearch(Request $request)
    {
        $products = Product::query();

        // keyword search
        if ($request->keyword) {
            $products->where('name', 'LIKE', '%' . $request->keyword . '%');
        }

        // category filter
        if ($request->category && $request->category !== 'all') {
            $products->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        $products = $products->with('category:id,slug')
            ->select('id', 'name', 'slug', 'category_id')
            ->limit(6)
            ->get();

        return response()->json($products);
    }       
}
