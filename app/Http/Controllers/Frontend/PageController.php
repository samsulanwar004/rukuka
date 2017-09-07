<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Designer;

class PageController extends BaseController
{

    public function index()
    {
    	return view('pages.index');
    }

    public function shop($category, $slug)
    {
    	$products = Product::whereHas('category', function ($query) use ($slug) {
            $query->where('slug', '=', $slug);
        })
        ->paginate(9);

        return view('pages.shop', compact('products', 'category'));

    }

    public function product($slug)
    {
    	$product = Product::where('slug', $slug)
    		->first();

    	return view('pages.product', compact('product'));
    }

    public function menu($parent)
    {
    	if ($parent == 'designers') {
    		$desingers = Designer::get();

    		return response()->json($desingers);
    	} else {
    		$categories = Category::where('name', $parent)
    		->first();

    		return response()->json($categories->childs);
    	}
    }
}
