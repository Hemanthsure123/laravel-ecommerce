<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->query('size')?$request->query('size'):12;
        $products = Product::orderBy('created_at','DESC')->paginate(12);
        $categories = Category::orderBy("name","ASC")->get();
        $brands = Brand::orderBy("name","ASC")->get();
        return view('shop',compact("products","size"));
    }

    public function product_details($product_slug)
    {
    $product = Product::where("slug",$product_slug)->first();

    if (!$product) {
        abort(404, 'Product not found.');
    }


    $rproducts = Product::where("slug","<>",$product_slug)->get()->take(8);
    return view('details',compact("product","rproducts"));
    }

}
