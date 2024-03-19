<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartApi extends Controller
{
  public function postCart(Request $request, $slug)
{
    $user_id = $request->user_id;
    $product = Product::where('slug', $slug)->first();
    $cart = ProductCart::where('user_id',$user_id)->where('product_id',$product->id)->first();
    $cartCount = ProductCart::where('user_id',$user_id)->count();

    if($user_id === null) {
        return response()->json([
        "status" => 'failed',
        'message' => "Log in first",
    ]);
    }


  
    //if product is not found
    if (!$product) {
        return response()->json([
            'status' => 'failed',
            'message' => 'Product not found',
            'data' => false
        ]);
    }
    // if there is alredy cart update qty only
    if($cart){
         $newTotalQty = $cart->total_qty + $request->total_qty;

        $oldcart = $cart->update([
            'total_qty' => $newTotalQty
        ]);

         return response()->json([
            'status' => 'success',
            'message' => 'Successfully added to cart',
            'data' => [
                'cartCount' => $cartCount
            ]
        ]);
    }
    //create if there is no cart
    $newcart = ProductCart::create([
        'product_id' => $product->id,
        'user_id' => $user_id,
        'total_qty' => $request->total_qty,
        'sale_price' => $request->sale_price
    ]);

    $updateCartCount = ProductCart::where('user_id',$user_id)->count();

    return response()->json([
        'status' => 'success',
        'message' => 'Successfully added to cart',
        'data' => [
            'cartCount' => $updateCartCount
        ]
    ]);
}
public function getCart($slug){
    $user = User::where('slug',$slug)->first();
    $cart = ProductCart::where('user_id',$user->id)->with('Product')->get();

    if(!$user) {
        return response()->json([
        "status" => 'failed',
        'message' => "Log in first",
    ]);
    }


    if($cart->count() === 0) {
        return response()->json([
        "status" => 'failed',
        'message' => "You don't have any cart yet",
        'data' => $cart
    ]);
    }

    return response()->json([
        "status" => 'success',
        'message' => "cart have already arrived",
        'data' => $cart
    ]);
}
public function deleteCart(Request $request, $slug)
{
    $cart_id = $request->cart_id;

    // Delete the cart item
    $deleted = ProductCart::where('id', $cart_id)->delete();

    $user = User::where('slug', $slug)->first();

    // Check if the user exists
    if (!$user) {
        return response()->json([
            "status" => 'failed',
            'message' => "Log in first",
        ]);
    }

    // Fetch the updated cart after deletion
    $cart = ProductCart::where('user_id', $user->id)->with('Product')->get();
    $updateCartCount = $cart->count(); // Update the cart count

    // Check if the cart is empty
    if ($updateCartCount === 0) {
        return response()->json([
            "status" => 'failed',
            'message' => "You don't have any cart yet",
            'data' => "No Cart"
        ]);
    }

    // Return success response with updated cart information
    return response()->json([
        "status" => 'success',
        'message' => "Deleted Cart",
        'data' => [
            'cartsCount' => $updateCartCount ? $updateCartCount : 0,
            'carts' => $cart
        ]
    ]);
}

public function deleteAllCart(Request $request, $id)
{
    // Check if the user is logged in
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            "status" => 'failed',
            'message' => "User not found",
            'data' => $id
        ]);
    }

    // Delete all products in the cart for the user
    $deleted = ProductCart::where('user_id', $id)->delete();

    // Retrieve updated cart information after deletion
    $updatedCart = ProductCart::where('user_id', $id)->with('product')->get();

    return response()->json([
        "status" => 'success',
        'message' => "Deleted",
        'data' => [
            'cartsCount' => $updatedCart->count(),
            'carts' => $updatedCart
        ]
    ]);
}



}
