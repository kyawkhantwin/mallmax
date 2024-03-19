<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view("admin.category.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validate = $request->validate([
            "name" => "required",
            "image" => "required|mimetypes:image/jpeg,image/png,image/jpg",
        ]);

        $name = $request -> name;

        $file = $request -> file('image');
        $image =$file-> getClientOriginalName();

        $file->move(public_path('/image'),$image);

//        Create category to database
        Category::create([
            'name' => $name,
            'image' => $image,
            'slug' => Str::slug($name),
        ]);

       return redirect()->back()->with('success','Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::where("slug",$id)->first();

        if (!$category){
            return redirect()->back()->with('error','Category does not exist');
        }

        return view("admin.category.edit",compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $validate = $request->validate([
            "name" => "required",
        ]);

        $category = Category::where('slug',$id)->first();
        $originImageName = $category->image;


        $name = $request->name;

        if (!$category){
            return redirect()->back()->with('error','Category does not exist');
        }

        if ($request -> file('image')){
            File::delete(public_path('image/').$originImageName);
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();

            $file->move(public_path('/image'),$imageName);

        }else{
            $imageName = $originImageName;
        }


        Category::where('slug',$id)->update([
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => $imageName
       ]);

        return  redirect('/admin/category')->with('success','Category updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('slug',$id)->first();

        if (!$category){
            return redirect()->back()->withErrors('error','Category not found');
        }
        File::delete(public_path('/image/').$category->image);

        $category->delete();

        return redirect()->back()->with('error','Category Deleted ');
    }
}
