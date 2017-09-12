<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;

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

    public function women()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Women Landing Page');

        $women = [];
        foreach ($settings as $key => $value) {
            $women[$value->name] = $value->content;
        }

        return view('pages.women', compact('women'));
    }

    public function men()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Men Landing Page');

        $men = [];
        foreach ($settings as $key => $value) {
            $men[$value->name] = $value->content;
        }

        return view('pages.men', compact('men'));
    }

    public function kids()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Kids Landing Page');

        $kids = [];
        foreach ($settings as $key => $value) {
            $kids[$value->name] = $value->content;
        }

        return view('pages.kids', compact('kids'));
    }

}
