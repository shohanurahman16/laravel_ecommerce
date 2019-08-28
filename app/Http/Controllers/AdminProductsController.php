<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::orderBy('id','desc')->get();
        return view('admin.pages.products.manage',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.products.create');
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
            'title'         =>    'required|max:150',
            'description'   =>    'required',
            'quantity'      =>    'required|numeric',
            'price'         =>    'required|numeric',
            'category_id'   =>    'required|numeric',
            'brand_id'      =>    'required|numeric',
//          'admin_id'      =>    'required|numeric',
//          'status'        =>    'required|numeric',
        ]);

        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->slug = str_slug($request->title);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->admin_id = 1;
        $product->save();

        //ProductImage Model inserting image
        if(count($request->product_image)>0)    {
            foreach ($request->product_image as $image){
                //insert that image

                //$image = $request->file('product_image');
                $img = time(). '.' . $image->getClientOriginalExtension();
                $location = public_path('images/products/'. $img);
                Image::make($image)->save($location);

                $product_image = new ProductImage;
                $product_image->product_id = $product->id;
                $product_image->image = $img;
                $product_image->save();
            }
        }

        return redirect()->route('admin.products.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);
        return view('admin.pages.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'title'         =>    'required|max:150',
            'description'   =>    'required',
            'quantity'      =>    'required|numeric',
            'price'         =>    'required|numeric',
//          'slug'          =>    'required',
//          'category_id'   =>    'required|numeric',
//          'brand_id'      =>    'required|numeric',
//          'admin_id'      =>    'required|numeric',
//          'status'        =>    'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $product->save();

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();
        Session::flash('deleted_product', 'Product has been deleted successfully');
        return back();
    }
}
