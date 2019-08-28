<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index() {
        $products = Product::orderBy('id','desc')->paginate(9);
        return view('pages.index', compact('products'));
    }

    public function contact()   {
        return view('pages.contact');
    }

    public function search(Request $request) {
        $search=$request->search;
        $products = Product::orWhere('title', 'like', '%'.$search.'%')
        ->orWhere('description', 'like', '%'.$search.'%')
        ->orWhere('price', 'like', '%'.$search.'%')
        ->orWhere('quantity', 'like', '%'.$search.'%')
        ->orderBy('id','desc')->paginate(9);
        return view('pages.products.search', compact('search','products'));
    }
}
