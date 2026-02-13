<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Comprar un producto
     */
    public function purchase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($request->product_id);
            $quantity = $request->quantity ?? 1;

            // Verificar stock disponible
            if ($product->stock < $quantity) {
                return response()->json([
                    'error' => 'Insufficient stock',
                    'available_stock' => $product->stock
                ], 400);
            }

            // Calcular totales
            $priceAtPurchase = (float) $product->price;
            $totalAmount = $priceAtPurchase * $quantity;

            // Crear la orden
            $order = Order::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => $quantity,
                'price_at_purchase' => $priceAtPurchase,
                'total_amount' => $totalAmount,
                'status' => 'completed'
            ]);

            // Reducir stock del producto
            $product->decrement('stock', $quantity);
            
            // Incrementar sales count
            $product->increment('salesCount', $quantity);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Purchase completed successfully!',
                'order' => $order->load('product'),
                'remaining_stock' => $product->fresh()->stock
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'error' => 'Purchase failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener las compras de un usuario
     */
    public function getUserOrders(Request $request, $userId)
    {
        try {
            $orders = Order::with('product')
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'orders' => $orders
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to load orders',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener todas las órdenes (admin)
     */
    public function index()
    {
        try {
            $orders = Order::with(['user', 'product'])
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json($orders, 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to load orders',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

        try {
            DB::beginTransaction();

            $totalAmount = 0;
            $orderProducts = [];

            // Verify stock and calculate total
            foreach ($request->products as $productData) {
                $product = Product::findOrFail($productData['id']);
                $quantity = $productData['quantity'];

                if ($product->stock < $quantity) {
                    return response()->json([
                        'error' => "Insufficient stock for {$product->name}. Available: {$product->stock}, Requested: {$quantity}"
                    ], 400);
                }

                $itemTotal = $product->price * $quantity;
                $totalAmount += $itemTotal;

                $orderProducts[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'total' => $itemTotal
                ];
            }

            // Create order
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'total_amount' => $totalAmount,
                'status' => 'completed'
            ]);

            // Create order items and update stock
            foreach ($orderProducts as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);

                // Decrease stock
                $item['product']->decreaseStock($item['quantity']);
            }

            DB::commit();

            return response()->json([
                'message' => 'Order created successfully',
                'order' => $order->load('orderItems.product'),
                'total' => $order->getTotalFormatted()
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Failed to create order',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $order = Order::with('orderItems.product')->findOrFail($id);
            
            return response()->json([
                'order' => $order,
                'items' => $order->orderItems->map(function($item) {
                    return [
                        'id' => $item->id,
                        'product' => $item->product,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'total' => $item->quantity * $item->price
                    ];
                })
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Order not found'
            ], 404);
        }
    }

    public function userOrders(Request $request)
    {
        $email = $request->query('email');
        
        if (!$email) {
            return response()->json([
                'error' => 'Email parameter is required'
            ], 400);
        }

        $orders = Order::with('orderItems.product')
                      ->where('customer_email', $email)
                      ->orderBy('created_at', 'desc')
                      ->get();

        return response()->json($orders);
    }
}
