<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class PageController extends BaseController
{

    public function index()
    {
    	return view('pages.index');
    }

    public function shop($category, $slug)
    {
    	$products = (new ProductRepository)->getProducts($category, $slug);

        return view('pages.shop', compact('products', 'category'));

    }

    public function product($slug)
    {
    	$product = (new ProductRepository)->getProductBySlug($slug);

    	return view('pages.product', compact('product'));
    }

}
