<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAddTransaction;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        $months = [];
        $monthlyUserCount = [];
        $monthlyOrderCount = [];

        // Calculate monthly user count for the last 6 months
        foreach (array_reverse(array_map(fn ($i) => now()->subMonths($i)->format('F Y'), range(0, 5))) as $month) {
            $userCount = User::whereMonth('created_at', '=', date('m', strtotime($month)))
                ->whereYear('created_at', '=', date('Y', strtotime($month)))
                ->count();
            $orderCount = Order::whereMonth('created_at', '=', date('m', strtotime($month)))
                ->whereYear('created_at', '=', date('Y', strtotime($month)))
                ->count();

            $months[] = $month;
            $monthlyUserCount[] = $userCount;
            $monthlyOrderCount[] = $orderCount;
        }

        $products = Product::latest()->take(5)->get();
        $categoryNames = Category::pluck('name')->all();
        $categoryCounts = [];
        
        foreach ($categoryNames as $categoryName) {
            $count = Category::where('name', $categoryName)->count();
            $categoryCounts[] = $count;
        }
        
        // Now $categoryCounts contains the count for each category
        // You can use or store this associative array as needed
        
        $transactions = ProductAddTransaction::latest()
            ->take(5)
            ->with('user')
            ->with('product')
            ->get();
            // Add transactions to the overall list

          
            
        

        return view('admin.dashboard', compact('months', 'monthlyUserCount', 'monthlyOrderCount', 'transactions','products','categoryNames','categoryCounts'));
    }

    public function Transaction(){
        $orders = ProductAddTransaction::with('product')->with('user')->latest()->paginate(10);


        return view('admin.transaction',compact('orders'));
    }
}


