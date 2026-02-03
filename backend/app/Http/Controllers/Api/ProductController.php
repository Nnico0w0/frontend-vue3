<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
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
        
        return ProductResource::collection($products);
    }
    
    public function show($id)
    {
        $product = Product::active()->findOrFail($id);
        return new ProductResource($product);
    }
    
    public function byCategory($category)
    {
        $products = Product::active()->byCategory($category)->get();
        return ProductResource::collection($products);
    }
}
