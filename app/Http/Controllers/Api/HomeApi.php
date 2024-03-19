<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use http\Env\Response;
use http\Message;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeApi extends Controller
{
    //
    public function index()
    {
        try {
            $products = Product::all();
            if($products -> isEmpty()){
               return response()->json([
                        'status' => "failed",
                        'message' => "No product was found",
                    ],404);
            }

          return  response()->json([
                'status' => "success",
                'message' => "product Api Successfully arrive",
                'data' => $products
            ]);

        }catch (\Exception $e){
            return response()->json([
                    'status' => "failed",
                    'message' => "Failed to retrieve product " . $e-> getMessage()
                ],500);
        }
    }

    public function detail($slug)
    {
        try {
            $product = Product::where('slug',$slug)->first();
            $reviews = ProductReview::where('product_id',$product->id)->with('User')->get();
            $four_random_products = Product::inRandomOrder()->limit(5)->get();



            if (!$product){
                return \response()->json([
                    'status' => 'failed',
                    'message' => 'Product Not Found'
                ],404);
            }

            return  response()->json([
                'status' => "success",
                'message' => "product Api Successfully arrive",
                'data' => ['productDetail' => $product ,
                            'productReviews' => $reviews,
                            'randProducts' =>$four_random_products ,
                           ]
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => "failed",
                'message' => "Failed to retrieve product " . $e-> getMessage()
            ],500);
        }
    }
    
    public function search($name)
    {
        try {
            $products = Product::where('name', 'like', "%$name%")->get();
    
            if ($products->isEmpty()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Product Not Found',
                ]);
            }
    
            return response()->json([
                'status' => 'success',
                'message' => 'Search',
                'data' => [
                    'products' => $products,
                    'count' => $products->count(),
                ],
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Failed to search product ' . $e->getMessage(),
            ], 500);
        }
    }
    
    
}
