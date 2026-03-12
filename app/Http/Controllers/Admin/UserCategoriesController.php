<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get(); // FETCH FROM DB
        return view('admin.categories.index', compact('categories'));

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|boolean',


        ]);

        Category::create([
            'name' => $request->name,
            'status' => $request->status,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'status' => 'required|boolean',
        ]);


        $category = Category::findOrFail($id);

        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $count = 1;

        while (
            Category::where('slug', $slug)
                ->where('id', '!=', $category->id)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        $category->update([
            'name' => $request->name,
            'status' => $request->status,
            'slug' => $slug,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
