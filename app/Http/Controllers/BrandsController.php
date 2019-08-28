<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
Use Image;
Use File;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = brand::orderBy('id', 'desc')->get();
        return view('admin.pages.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name'         =>    'required|max:150',
            'image'        =>    'nullable|image',
        ],
            [
                'name.required' =>  'Please insert a brand name',
                'image.image'   =>  'Please insert a valid image with .jpg, .jpeg, .png, .gif extention...'
            ]

        );

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->description = $request->description;


        //ProductImage Model inserting image
        if($request->image)   {
            //insert that image
            $image = $request->file('image');
            $img = time(). '.' . $image->getClientOriginalExtension();
            $location = public_path('images/brands/'. $img);
            Image::make($image)->save($location);

            //saving image to the table
            $brand->image = $img;
        }

        Session::flash('add_brand', 'Brand has been added successfully');
        $brand->save();

        return redirect()->route('admin.brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $brand = brand::findOrFail($id);
        return view('admin.pages.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name'         =>    'required|max:150',
            'image'        =>    'nullable|image',
        ],

            [
                'name.required' =>  'Please insert a brand name',
                'image.image'   =>  'Please insert a valid image with .jpg, .jpeg, .png, .gif extention...'
            ]

        );

        $brand = brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->description = $request->description;


        //Updating image
        if($request->image)   {
            //delete old image
            if(File::exists('images/brands/'.$brand->image)) {
                File::delete('images/brands/'.$brand->image);
            }

            //insert new image
            $image = $request->file('image');
            $img = time(). '.' . $image->getClientOriginalExtension();
            $location = public_path('images/brands/'. $img);
            Image::make($image)->save($location);
            //saving image to the table
            $brand->image = $img;
        }

        Session::flash('update_brand', 'Brand has been updated successfully');
        $brand->save();
        return redirect()->route('admin.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //delete brand image
        if(File::exists('images/brands/'.$brand->image)) {
            File::delete('images/brands/'.$brand->image);
        }
        $brand->delete();
        Session::flash('deleted_brand', 'Brand has been deleted successfully');
        return back();
    }
}
