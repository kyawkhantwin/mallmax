<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewApi extends Controller
{
    //
    public function makeReview(Request $request, $slug)
    {
        $user_id = $request->user_id;
        $rating = $request->rating;

        $review = $request->review;

        // Check if the product exists in the database based on the slug
        $product = Product::where('slug', $slug)->first();

        $userReviews = ProductReview::where('user_id', $user_id)
            ->where('product_id', $product->id)
            ->count();

        if (!$product){
            return response()->json([
                "status" => "failed",
                'message' => "Product Not Found.Review Failed To Upload."
            ]);
        }
        // check user have already been review or not
        if ($userReviews > 0 ){
            return response()->json([
                "status" => "failed",
                'message' => "You can write review once per product."
            ]);
        }

// If the product is found, create a new product review
         $newReview = ProductReview::create([
            'user_id' => $user_id,
            "product_id" => $product->id,
            'rating' => $rating,
            "review" => $review,
        ]);

        //Data to update so no need to refresh
        $productReviewList = ProductReview::where('id',$newReview->id)->with('User')->get();

        return response()->json([
            "status" => "success",
            'message' => "Your review has been successfully uploaded",
            "review" => $productReviewList,

        ]);




    }






}
