<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        return view('admin.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,'
        ]);

        $name = $request->name;
        $image = $request->file('image');
        $image_name = $image->getClientOriginalName();

        $image-> move(public_path('/image/brand' ), $image_name);

        Brand::create([
           'name' => $name,
           'image' => $image_name,
           'slug' => Str::slug($name)
        ]);

        return redirect()->back()->with('success','You Added new Brand');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::where("slug",$id)->first();

        if (!$brand){
           return redirect()->back()->with('error','Brand does not exist');
        }

       return view('admin.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request ->validate([
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,'
        ]);

        $brand = Brand::where("slug",$id);

        $brand->update([
            'slug' => Str::slug($request->name),
            "name" => $request->name,
            'image' => $request ->image
        ]);

        return redirect()->back()->with('success','Brand Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
