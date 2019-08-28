<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;
use File;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $parent_categories = Category::orderBy('id','desc')->where('parent_id', null)->get();
        return view('admin.pages.categories.create', compact('parent_categories'));
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
            'name.required' =>  'Please insert a category name',
            'image.image'   =>  'Please insert a valid image with .jpg, .jpeg, .png, .gif extention...'
        ]

        );

        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;


        //ProductImage Model inserting image
            if($request->image)   {
                //insert that image
                $image = $request->file('image');
                $img = time(). '.' . $image->getClientOriginalExtension();
                $location = public_path('images/categories/'. $img);
                Image::make($image)->save($location);

                //saving image to the table
                $category->image = $img;
            }

        Session::flash('add_category', 'Category has been added successfully');
        $category->save();

        return redirect()->route('admin.categories.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::findOrFail($id);
        $parent_categories = Category::orderBy('id','desc')->where('parent_id', null)->get();
        return view('admin.pages.categories.edit', compact('category','parent_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
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
                'name.required' =>  'Please insert a category name',
                'image.image'   =>  'Please insert a valid image with .jpg, .jpeg, .png, .gif extention...'
            ]

        );

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;


        //Updating image
        if($request->image)   {
            //delete old image
            if(File::exists('images/categories/'.$category->image)) {
                File::delete('images/categories/'.$category->image);
            }

            //insert new image
            $image = $request->file('image');
            $img = time(). '.' . $image->getClientOriginalExtension();
            $location = public_path('images/categories/'. $img);
            Image::make($image)->save($location);
            //saving image to the table
            $category->image = $img;
        }

        Session::flash('update_category', 'Category has been updated successfully');
        $category->save();
        return redirect()->route('admin.categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //if parent category, delete sub-category
        if($category->parent_id == NULL)   {
            $sub_categories = Category::orderBy('id','desc')->where('parent_id', $category->id)->get();
            foreach ($sub_categories as $sub)
            {
                //delete category image
                if(File::exists('images/categories/'.$sub->image)) {
                    File::delete('images/categories/'.$sub->image);
                }
                $sub->delete();
            }
        }

        //delete category image
        if(File::exists('images/categories/'.$category->image)) {
            File::delete('images/categories/'.$category->image);
        }
        $category->delete();
        Session::flash('deleted_category', 'Category has been deleted successfully');
        return back();
    }
}
