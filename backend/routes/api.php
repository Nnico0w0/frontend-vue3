<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

// Health check
Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'API funcionando correctamente',
        'timestamp' => now()
    ]);
});

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public routes - Products
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/top-selling/{limit?}', [ProductController::class, 'topSelling']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/category/{category}', [ProductController::class, 'byCategory']);

// Public routes - Categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);

// Legacy routes for compatibility
Route::get('/product', [ProductController::class, 'index']);
Route::get('/category', [CategoryController::class, 'index']);

// Protected routes with JWT
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Admin routes - require authentication and admin privileges
Route::middleware(['auth:api', 'admin'])->group(function () {
    // Admin Products CRUD
    Route::post('/admin/products', [ProductController::class, 'store']);
    Route::put('/admin/products/{id}', [ProductController::class, 'update']);
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy']);
    
    // Admin Categories CRUD
    Route::post('/admin/categories', [CategoryController::class, 'store']);
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy']);
    
    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        $totalProducts = \App\Models\Product::count();
        $totalCategories = \App\Models\Category::count();
        $totalUsers = \App\Models\User::count();
        
        return response()->json([
            'stats' => [
                'total_products' => $totalProducts,
                'total_categories' => $totalCategories,
                'total_users' => $totalUsers,
            ]
        ]);
    });

    // Admin Orders
    Route::get('/admin/orders', [OrderController::class, 'index']);
});

// User purchase routes - require authentication but not admin
Route::middleware('auth:api')->group(function () {
    Route::post('/purchase', [OrderController::class, 'purchase']);
    Route::get('/orders/{userId}', [OrderController::class, 'getUserOrders']);
});

// Public purchase route for demo (without auth for easier testing)
Route::post('/purchase-public', [OrderController::class, 'purchase']);
Route::get('/orders-public/{userId}', [OrderController::class, 'getUserOrders']);
