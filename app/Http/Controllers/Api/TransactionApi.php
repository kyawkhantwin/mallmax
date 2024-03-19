<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductAddTransaction;

class TransactionApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $transaction = Order::where('user_id',$request->user_id)->latest()->get();
          return response()->json([
                'status' => 'success',
                'message' => 'Orders retrieved successfully',
                'data' => $transaction,
                 'user' =>$request->user_id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ]);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Request $request ,$orderId)
    {
        try {
            $transaction = ProductAddTransaction::where('order_id',$orderId)->with('product')->with('order')->get();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Order retrieved successfully',
                'data' => $transaction
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Order not found',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        $request->validate([
            'user_id' => 'required',
            'cartDetail' => 'required|array',
            'total_price'=> 'required'
        ]);

        // Check if the user exists
        $user = User::findOrFail($request->user_id);

        // Create an order
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $request->total_price
        ]);

      
        $data = []; 
        foreach($request->cartDetail as $cart) {
            $transaction = ProductAddTransaction::create([
                'order_id' => $order->id,
                'user_id' => $user->id,
                'product_id' => $cart['product_id'],
                'total_qty' => $cart['total_qty'],
                'sale_price' => $cart['sale_price'],
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction created successfully',
            'data' => $data
    
        ]);
    } catch (ModelNotFoundException $e) {
        // Handle if user not found
        return response()->json([
            'status' => 'failed',
            'message' => 'User not found',
        ]);
    } catch (\Exception $e) {
        // Handle other exceptions
        return response()->json([
            'status' => 'failed',
            'message' => $e->getMessage(),
            'error' => $e->getMessage(),
        ]);
    }
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Your implementation for update method
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Your implementation for destroy method
    }
}
