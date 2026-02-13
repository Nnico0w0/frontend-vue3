<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::active()->get();
        
        return response()->json($categories->map(function($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'description' => $category->description,
                'imageURL' => $category->image_url,
                'productCount' => $category->product_count
            ];
        }));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::active()->findOrFail($id);
        
        return response()->json([
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->description,
            'imageURL' => $category->image_url,
            'productCount' => $category->product_count
        ]);
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'is_active' => true,
            'product_count' => 0
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category
        ], 201);
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'is_active' => 'boolean'
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'is_active' => $request->is_active ?? true
        ]);

        return response()->json([
            'message' => 'Category updated successfully',
            'category' => $category
        ]);
    }

    /**
     * Remove the specified category.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Check if category has products
        $productCount = \App\Models\Product::where('category', $category->name)->count();
        if ($productCount > 0) {
            return response()->json([
                'error' => 'Cannot delete category with existing products'
            ], 422);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }
}
