<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active();
        
        if ($request->has('category')) {
            $query->byCategory($request->category);
        }
        
        $products = $query->get();
        
        return response()->json($products->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => number_format($product->price, 2),
                'imageURL' => $product->image_url,
                'category' => $product->category,
                'author' => $product->author,
                'stock' => $product->stock,
                'discount' => $product->discount_percentage > 0 ? $product->discount_percentage : null,
                'originalPrice' => $product->discount_percentage > 0 ? 
                    number_format($product->price * (1 + $product->discount_percentage/100), 2) : null,
                'salesCount' => $product->sales_count,
                'isFeatured' => $product->is_featured
            ];
        }));
    }
    
    public function show($id)
    {
        $product = Product::active()->findOrFail($id);
        
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => number_format($product->price, 2),
            'imageURL' => $product->image_url,
            'category' => $product->category,
            'author' => $product->author,
            'stock' => $product->stock,
            'discount' => $product->discount_percentage > 0 ? $product->discount_percentage : null,
            'originalPrice' => $product->discount_percentage > 0 ? 
                number_format($product->price * (1 + $product->discount_percentage/100), 2) : null,
            'salesCount' => $product->sales_count,
            'isFeatured' => $product->is_featured
        ]);
    }
    
    public function byCategory($category)
    {
        $products = Product::active()->byCategory($category)->get();
        
        return response()->json($products->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => number_format($product->price, 2),
                'imageURL' => $product->image_url,
                'category' => $product->category,
                'author' => $product->author,
                'stock' => $product->stock,
                'discount' => $product->discount_percentage > 0 ? $product->discount_percentage : null,
                'originalPrice' => $product->discount_percentage > 0 ? 
                    number_format($product->price * (1 + $product->discount_percentage/100), 2) : null,
                'salesCount' => $product->sales_count,
                'isFeatured' => $product->is_featured
            ];
        }));
    }

    public function topSelling($limit = 3)
    {
        $products = Product::active()->topSelling($limit)->get();
        
        return response()->json($products->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => number_format($product->price, 2),
                'imageURL' => $product->image_url,
                'category' => $product->category,
                'author' => $product->author,
                'stock' => $product->stock,
                'discount' => $product->discount_percentage > 0 ? $product->discount_percentage : null,
                'originalPrice' => $product->discount_percentage > 0 ? 
                    number_format($product->price * (1 + $product->discount_percentage/100), 2) : null,
                'salesCount' => $product->sales_count,
                'isFeatured' => $product->is_featured
            ];
        }));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'stock' => 'required|integer|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'author' => 'nullable|string',
            'is_featured' => 'boolean'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'image_url' => $request->image_url,
            'stock' => $request->stock,
            'discount_percentage' => $request->discount_percentage ?? 0,
            'sales_count' => 0,
            'is_active' => true,
            'author' => $request->author,
            'is_featured' => $request->is_featured ?? false
        ]);

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product
        ], 201);
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'stock' => 'required|integer|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'author' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'image_url' => $request->image_url,
            'stock' => $request->stock,
            'discount_percentage' => $request->discount_percentage ?? 0,
            'author' => $request->author,
            'is_featured' => $request->is_featured ?? false,
            'is_active' => $request->is_active ?? true
        ]);

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified product.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
