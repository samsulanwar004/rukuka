<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\DesignerRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Repositories\PageRepository;
use App\Repositories\LookbookRepository;
use App\Repositories\UserRepository;
use App\Repositories\ExchangeRateRepository;
use Exception;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Services\ClientService;


class PageController extends BaseApiController
{

    CONST MENU_CACHE = 'menu.cache';
    CONST CATEGORIES_CACHE = 'categories.cache';
    CONST COLOR_CACHE = 'color.cache';
    CONST POPULAR_CACHE = 'popular.cache';
    CONST EXCHANGE_CACHE = 'exchange.cache';

    public function __construct()
    {
        $this->date = Carbon::now('Asia/Jakarta');
    }
    
    public function menu(Request $request, $parent = null)
    {
    	try {

            if (Cache::has(self::MENU_CACHE.'.'.$parent)) {
                $categories = Cache::get(self::MENU_CACHE.'.'.$parent);
            } else {
                //Designer List
                $categories = (new CategoryRepository)->getCategories();
                $categories = collect($categories)->mapWithKeys(function ($item) {
                    return [strtolower($item['name']) => $item['child']];
                })->toArray();

                $designers = (new DesignerRepository)->getDesignerWithGender();

                $categoryArr = (new ProductRepository)->getCategoryProduct($request, $parent);

                if(count($categoryArr) != 0){
                    $categoryArray = [];
                    foreach ($categoryArr as $value)
                        $categoryArray[] = $value->category_name;
                }
                else{
                    $categoryArray = [];
                }

                //category for mens
                $categoryArrMens = (new ProductRepository)->getCategoryProduct($request, 'mens');

                if(count($categoryArrMens) != 0){
                    $categoryArrayMens = [];
                    foreach ($categoryArrMens as $value)
                        $categoryArrayMens[] = $value->category_name;
                }
                else{
                    $categoryArrayMens = [];
                }

                //category for womens
                $categoryArrWomens = (new ProductRepository)->getCategoryProduct($request, 'womens');

                if(count($categoryArrWomens) != 0){
                    $categoryArrayWomens = [];
                    foreach ($categoryArrWomens as $value)
                        $categoryArrayWomens[] = $value->category_name;
                }
                else{
                    $categoryArrayWomens = [];
                }

                $categories['category_available'] = $categoryArray;
                $categories['category_mens_available'] = $categoryArrayMens;
                $categories['category_womens_available'] = $categoryArrayWomens;

                $categories['designers_all'] = collect($designers)->unique('name')->values();

                $designers = collect($designers)->filter(function ($item) use ($parent) {
                    return $item->gender == $parent || $item->gender == 'unisex';
                })->unique('name')->values();

                $categories['designers'] = $designers;

                //Designer Navigation
                $designersResult = (new DesignerRepository)->getDesignersNav();
                $designersResult = collect($designersResult)->mapWithKeys(function ($item) {
                    return [strtolower($item['name']) => $item['content']];
                })->toArray();
                $categories['designers_nav'] = $designersResult;

                //Women Navigation
                $womensResult = (new DesignerRepository)->getWomensNav();
                $womensResult = collect($womensResult)->mapWithKeys(function ($item) {
                    return [strtolower($item['name']) => $item['content']];
                })->toArray();
                $categories['womens_nav'] = $womensResult;

                //Men Navigation
                $MensResult = (new DesignerRepository)->getMensNav();
                $MensResult = collect($MensResult)->mapWithKeys(function ($item) {
                    return [strtolower($item['name']) => $item['content']];
                })->toArray();
                $categories['mens_nav'] = $MensResult;

                //Kid Navigation
                $KidsResult = (new DesignerRepository)->getKidsNav();
                $KidsResult = collect($KidsResult)->mapWithKeys(function ($item) {
                    return [strtolower($item['name']) => $item['content']];
                })->toArray();
                $categories['kids_nav'] = $KidsResult;

                //Sale Navigation
                $SaleResult = (new DesignerRepository)->getSalesNav();
                $SaleResult = collect($SaleResult)->mapWithKeys(function ($item) {
                    return [strtolower($item['name']) => $item['content']];
                })->toArray();
                $categories['sales_nav'] = $SaleResult;

                $expiresAt = Carbon::now()->addMinutes(60);

                Cache::put(self::MENU_CACHE.'.'.$parent, $categories, $expiresAt);
            }
                

                return $this->success($categories, 200, true);
    	} catch (Exception $e) {
    		return $this->error($e, 400, true);
    	}
    }

    public function search($keyword = null)
    {
        try {
            $categories['designers'] = (new DesignerRepository)->getDesignersByKeyword($keyword);
            $products = (new ProductRepository())->getProductByKeyword($keyword);

           $product = $products->map(function ($entry) {
               return [
                   'category' => $entry->category->parent->parent->name
               ];
           });
            $mens = 0;
            $womens = 0;
            $kids = 0;
            $home = 0;

            foreach ($product as $prod) {
                if ($prod['category'] == 'Mens') {
                    $mens++;
                } else if ($prod['category'] == 'Womens') {
                    $womens++;
                } else if ($prod['category'] == 'Home') {
                    $home++;
                } else {
                    $kids++;
                }
            }

            $categories['mens'] = $mens;
            $categories['womens'] = $womens;
            $categories['home'] = $home;
            $categories['kids'] = $kids;

            return $this->success($categories, 200, true);

        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function popular(Request $request, $group)
    {
        try {
            if (Cache::has(self::POPULAR_CACHE.'.'.$group)) {
                $popular = Cache::get(self::POPULAR_CACHE.'.'.$group);
            } else {
                $popular = (new ProductRepository)->getMostProduct($group);

                $expiresAt = Carbon::now()->addMinutes(60);

                Cache::put(self::POPULAR_CACHE.'.'.$group, $popular, $expiresAt);
            }

            //get wishlist
            $wishlists = [];
            if ($user = $this->getUserActive()) {
                $wishlists = (new UserRepository)->getWishlistByUserId($user->id);
                $wishlists = $wishlists->map(function($entry) {
                    return $entry->id;
                })->toArray();
            }

            $popular = $popular->map(function ($entry) use ($request, $wishlists) {

                $like = in_array($entry->id, $wishlists) ? true : false;

                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'gender' => $entry->gender,
                    'slug' => $entry->gender != 'unisex' ? $entry->slug : $entry->slug.'?menu='.$request->input('menu'),
                    'price' => $entry->sell_price,
                    'price_before_discount' => $entry->price_before_discount,
                    'photo' => $entry->photo ? str_replace('original', 'small', $entry->photo) : $entry->photo,
                    'is_new' => $this->date->diffInDays(Carbon::parse($entry->created_at)) <= 7 ? true : false,
                    'designer_name' => $entry->designer_name,
                    'designer_slug' => $entry->designer_slug,
                    'like' => $like
                ];
            })->toArray();

            return $this->success($popular, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function related(Request $request, $categoryId)
    {
        try {
            $related = (new ProductRepository)->getRelatedProduct($categoryId);

            //get wishlist
            $wishlists = [];
            if ($user = $this->getUserActive()) {
                $wishlists = (new UserRepository)->getWishlistByUserId($user->id);
                $wishlists = $wishlists->map(function($entry) {
                    return $entry->id;
                })->toArray();
            }

            $related = $related->map(function ($entry) use ($request, $wishlists) {

                $like = in_array($entry->id, $wishlists) ? true : false;

                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'gender' => $entry->gender,
                    'slug' => $entry->gender != 'unisex' ? $entry->slug : $entry->slug.'?menu='.$request->input('menu'),
                    'price' => $entry->sell_price,
                    'price_before_discount' => $entry->price_before_discount,
                    'photo' => $entry->photo ? str_replace('original', 'small', $entry->photo) : $entry->photo,
                    'is_new' => $this->date->diffInDays(Carbon::parse($entry->created_at)) <= 7 ? true : false,
                    'designer_name' => $entry->designer_name,
                    'designer_slug' => $entry->designer_slug,
                    'like' => $like
                ];
            })->toArray();

            return $this->success($related, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function product($id = null)
    {
        try {
            $product = (new ProductRepository)->getProductById($id);

            $product->images_medium = $product->images->map(function($entry) {
                return [
                    'name' => $entry->name,
                    'photo' => str_replace('original', 'medium', $entry->photo)
                ];
            });

            $product->stocks->toArray();

            $color = $product->palette;

            $product->color = $color->name;
            $product->color_palette = $color->palette;

            $product = collect($product)->all();

            return $this->success($product, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function popularSearch(){
        try {
            $settings = (new SettingRepository)->getSettingByGroup('Popular Search');

            $popularSearch = collect($settings)->mapWithKeys(function ($item) {
                return [$item['name'] => $item['content']];
            })->toArray();

            return $this->success($popularSearch, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function recently(Request $request)
    {
        try {

            //get wishlist
            $wishlists = [];
            if ($user = $this->getUserActive()) {
                $wishlists = (new UserRepository)->getWishlistByUserId($user->id);
                $wishlists = $wishlists->map(function($entry) {
                    return $entry->id;
                })->toArray();
            }

            $product = $request->input('product');

            $recently = (new ProductRepository)->getRecentlyViewedProduct($product);

            $recently = $recently->map(function ($entry) use ($request, $wishlists) {

                $like = in_array($entry->id, $wishlists) ? true : false;

                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'gender' => $entry->gender,
                    'slug' => $entry->gender != 'unisex' ? $entry->slug : $entry->slug.'?menu='.$request->input('menu'),
                    'price' => $entry->sell_price,
                    'price_before_discount' => $entry->price_before_discount,
                    'photo' => $entry->photo ? str_replace('original', 'small', $entry->photo) : $entry->photo,
                    'is_new' => $this->date->diffInDays(Carbon::parse($entry->created_at)) <= 7 ? true : false,
                    'designer_name' => $entry->designer_name,
                    'designer_slug' => $entry->designer_slug,
                    'like' => $like
                ];
            })->toArray();

            return $this->success($recently, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function colorPalette()
    {
        try {
            if (Cache::has(self::COLOR_CACHE)) {
                $color = Cache::get(self::COLOR_CACHE);
            } else {
                $color = (new ProductRepository)->getColorPalette();

                $color = $color->map(function ($entry) {
                    return [
                        'id' => $entry->id,
                        'name' => $entry->name,
                        'palette' => uploadCDN($entry->palette)
                    ];
                })->toArray();

                $expiresAt = Carbon::now()->addMinutes(60);

                Cache::put(self::COLOR_CACHE, $color, $expiresAt);
            }

            return $this->success($color, 200, true);

        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function lookbook(Request $request)
    {
        try {

            $product = $request->input('product');

            $recently = (new ProductRepository)->getLookbookProduct($product);

            $ids = [];
            foreach ($recently as $value) {
                $ids[] = $value->id;
            }

            $image = (new ProductRepository)->getProductImage($ids);

            $recently = $recently->map(function ($entry) use ($image) {

                foreach ($image as $value) {
                    if ($entry->id == $value->products_id) {
                        $entry->photo = $value->photo;
                    }
                }

                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'slug' => $entry->slug,
                    'price' => $entry->sell_price,
                    'price_before_discount' => $entry->price_before_discount,
                    'currency' => $entry->currency,
                    'photo' => $entry->photo ? str_replace('original', 'small', $entry->photo) : $entry->photo,
                ];
            })->toArray();

            return $this->success($recently, 200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function typeahead($keyword = null)
    {
        try {
            $designer = (new DesignerRepository())->getDesignersByKeyword($keyword);

            $designerName = array();
            foreach($designer as $value)
            {
                $designerName[] = $value['name'];
            }

            $datas = [
                'status' => true,
                'urlPattern' => "/designer/#id#/#display#/",
                'data' => $designerName,
            ];
            echo  json_encode($datas);


        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function categories()
    {
        try {
            if (Cache::has(self::CATEGORIES_CACHE)) {
                $categories = Cache::get(self::CATEGORIES_CACHE);
            } else {
                $categories = (new CategoryRepository)->getCategories();

                $expiresAt = Carbon::now()->addMinutes(60);

                Cache::put(self::CATEGORIES_CACHE, $categories, $expiresAt);
            }

            return $this->success($categories,200, true);
        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }

    public function exchangeRate()
    {
        try {

            $rate = (new ExchangeRateRepository)->getExchangeRateUnique();

            if (Cache::has(self::EXCHANGE_CACHE)) {
                $exchange = Cache::get(self::EXCHANGE_CACHE);
            } else {
                $exchange = [];
                foreach ($rate as $value) {
                    if (!in_array($value->currency_code_to, array('bnd','idr'))) {
                        //get exchange rates live
                        $url = 'https://exchangeratesapi.io/api/latest?base='.strtoupper($value->currency_code_to).'&symbols=IDR';
                        $method = 'get';
                        $type = 'json';
                        $exchangeRate = (new ClientService)->request($method, $url, $type, $data = null, $auth = null);

                        $exchange[] = $exchangeRate;
                    }
                }

                $expiresAt = Carbon::now()->addMinutes(1440);

                Cache::put(self::EXCHANGE_CACHE, $exchange, $expiresAt);
            }

            $exchange = collect($exchange)->map(function($entry) {
                return [
                    'base' => $entry['base'],
                    'idr' => round($entry['rates']['IDR'])
                ];
            })->toArray();

            return $this->success($exchange, 200, true);

        } catch (Exception $e) {
            return $this->error($e, 400, true);
        }
    }
}
