<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use Exception;
use Carbon\Carbon;

class PageController extends BaseController
{
    private $date;

    public function __construct()
    {
        $this->date = Carbon::now('Asia/Jakarta');
    }

    public function index()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Home Page');

        $home = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

    	return view('pages.index', compact('home'));
    }

    public function shop(Request $request, $categories, $category, $slug = null)
    {

        if ($categories == 'designers') {
            $products = (new ProductRepository)->getProductByDesigner($request, $category);
        } else {
            if ($category == 'all') {
                $products = (new ProductRepository)->getProductByCategory($request, $categories);
            } else {
                $products = (new ProductRepository)->getProductBySlugCategory($request, $slug);      
            }  
        }

        foreach ($request->all() as $key => $value) {
            $products->appends($key, $value);
        }

        return view('pages.shop', compact('products', 'categories', 'category', 'slug'));

    }

    public function product($slug)
    {
    	$product = (new ProductRepository)->getProductBySlug($slug);

    	return view('pages.product', compact('product'));
    }

    public function women()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Women Landing Page');

        $women = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

        return view('pages.women', compact('women'));
    }

    public function men()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Men Landing Page');

        $men = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

        return view('pages.men', compact('men'));
    }

    public function kids()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Kids Landing Page');

        $kids = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

        return view('pages.kids', compact('kids'));
    }

    public function activation($code)
    {
        try {
            $user = (new UserRepository)->getUserByActivationCode($code);

            if (!$user) {
                throw new Exception("Activation code not found!", 1);   
            }

            if ($user->verification_expired <= $this->date) {
                throw new Exception("Activation code expired!", 1);                
            }

            $user->status = 1;
            $user->is_verified = 1;

            $user->update();
        } catch (Exception $e) {
            return view('pages.landing')->withErrors($e->getMessage());
        }

        return view('pages.landing')->withErrors(['success' => 'Activation successfully!']);
    }

}
