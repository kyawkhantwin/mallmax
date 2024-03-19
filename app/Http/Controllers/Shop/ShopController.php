<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductCart;

class ShopController extends Controller
{

    public function passCartToMaster(){
        if(auth()->check()){
            $cart_count = ProductCart::where('user_id', auth()->id)->count();
        }
        $cart_count = '0';
        return view('shop.master',compact('cart_count'));
    }
    public function index()
    {
        return view('shop.index');
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug',$slug)->first();
        if (!$product){
            return  redirect()->back()->with('error',"Product Not Found");
        }

        return view('shop.product_detail',compact('slug'));
    }

    public function postProductReview(Request $request,$slug)
    {
        $rate = $request->rate;
        $review = $request->review;

        return $rate. $review .$slug;
    }
    public function productCart(){
        return view('shop.product_cart');
    }
    public function search(){
        return view('shop.search');
    }
    public function transaction(){
        return view('shop.transaction');
    }
    public function transactionDetail($id){
        return view('shop.transaction_detail',compact('id'));
    }
    
}
