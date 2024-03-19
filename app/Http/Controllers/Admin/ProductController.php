<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\Supplier;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $brands = Brand::all();
        $colors = Color::all();

        return view('admin.product.create',compact('categories','suppliers','brands','colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'supplier' => 'required',
            'category' => 'required',
            'color' => 'required',

            'name' => 'required',
            'image' => 'required',
            'total_qty' => 'required',
            'sale_price' => 'required',
        ]);
        $supplier = Supplier::where('slug',$request->supplier)->first();
        if (!$supplier){
            return redirect()->back()->with('success','Supplier not found');
        }
        $brand = Brand::where('slug',$request->brand)->first();
        if (!$brand){
            return redirect()->back()->with('success','Brand not found');
        }
        $category = Category::where('slug',$request -> category)->first();
        if (!$category){
            return redirect()->back()->with('success','Category not found');
        }

        $colors = [];
        foreach ($request->color as $c){
            $color = Color::where('slug', $c)->first();
            if (!$color){
                return redirect()->back()->with('error',"Color not found");
            }
            $colors[] = $color->id;
        }



        $file = $request->file('image');
        $image_name = $file->getClientOriginalName();
        $file->move(public_path('/image/product'),$image_name);

        $product = Product::create([
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'name' => $request->name,
            'image' => $image_name,
            'slug' => uniqid().Str::slug($request->name).uniqid(),
            'description' => $request->description,
            'total_qty' => $request->total_qty,
            'sale_price' => $request->sale_price,
            'discount_price' => $request->discount_price,
        ]);

        foreach ($colors as $color){
            ProductColor::create([
                'product_id' => $product -> id,
                'color_id' => $color,
            ]);
        }


        return redirect()->back()->with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('slug',$id)->first();
        if (!$product){
            return redirect('/admin/product/')->with('error','Product Not Found');
        }
        return view('admin.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('slug',$id);

        $product->delete();

        return redirect()->back()->with('error','successfully deleted product');
    }
}
