<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductStockRepository;
use Exception;
use Carbon\Carbon;
use App\Services\BagService;

class PageController extends BaseController
{
    const INSTANCE_SHOP = 'shopping';

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

    public function bag(Request $request)
    {

        $bag = new BagService;

        //add or update product item to bag
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'size' => 'required|string|max:255'
            ]);  

            $stock = (new ProductStockRepository)->getStockBySku($request->input('size'));

            $product = [
                'id' => $stock->sku, 
                'name' => $stock->product->name, 
                'qty' => $request->has('qty') ? $request->input('qty') : 1, 
                'price' => $stock->product->sell_price, 
                'options' => [
                    'size' => $stock->size,
                    'color' => $stock->product->color,
                    'photo' => $stock->product->images->first()->photo,
                    'description' => $stock->product->content
                ]
            ];

            $bag->save($product, self::INSTANCE_SHOP);
  
        }

        //increment the quantity
        if ($request->has('increment')) {

            $rowId = $bag->search($request->input('increment'), self::INSTANCE_SHOP);

            if ($rowId) {
                $item = $bag->getItemByRowId($rowId);

                $bag->update($rowId, $item->qty + 1);
            }
        }

        //decrease the quantity
        if ($request->has('decrease')) {
            $rowId = $bag->search($request->input('decrease'), self::INSTANCE_SHOP);

            if ($rowId) {
                $item = $bag->getItemByRowId($rowId);

                $bag->update($rowId, $item->qty - 1);
            }
        }

        //remove the item
        if ($request->has('remove')) {
            $rowId = $bag->search($request->input('remove'), self::INSTANCE_SHOP);

            if ($rowId) {
                $bag->remove($rowId);
            }
        } 

        //remove the item from wishlist
        if ($request->has('move')) {
            (new UserRepository)->wishlistDestroy($request->input('move'));
        }       

        $bags = $bag->get(self::INSTANCE_SHOP);

        $subtotal = $bag->subtotal();

        return view('pages.bag', compact('bags', 'subtotal'));
    }
    

}
