<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductStockRepository;
use App\Repositories\PageRepository;
use Exception;
use Carbon\Carbon;
use App\Services\BagService;
use Share;

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

    public function shop(Request $request, $categories, $category, $slug = null, $sale = null)
    {

        if ($categories == 'designers') {
            $product = (new ProductRepository);
            $products = $product->getProductByDesigner($request, $category);
            $designer = $product->getDesigner();
        } else {
            if ($category == 'all') {
                $products = (new ProductRepository)->getProductByCategory($request, $categories);
            }else if($category == 'sale'){
                $products = (new ProductRepository)->getProductByCategorySale($request, $categories);
            } else {
                if($sale == 'sale'){
                    $products = (new ProductRepository)->getProductBySlugCategorySale($request, $slug);
                }
                else{
                $products = (new ProductRepository)->getProductBySlugCategory($request, $slug);
                }
            }
        }

        foreach ($request->all() as $key => $value) {
            $products->appends($key, $value);
        }

        $shops = $products->map(function ($entry) {
            return [
                'id' => $entry->id,
                'name' => $entry->name,
                'slug' => $entry->slug,
                'price' => $entry->sell_price,
                'price_before_discount' => $entry->price_before_discount,
                'currency' => $entry->currency,
                'photo' => $entry->images->first()->photo,
            ];
        });

        return view('pages.shop', compact(
            'products',
            'categories',
            'category',
            'slug',
            'designer',
            'shops',
            'sale'
        ));

    }

    public function product($slug, $method = null, $sku = null, $id = null)
    {
    	$product = (new ProductRepository)->getProductBySlug($slug);

        $share = Share::load(route('product', ['slug' => $slug]), $product->name, route('index').'/'.$product->images->first()->photo)
            ->services(
                'facebook',
                'gplus',
                'twitter',
                'gmail',
                'pinterest',
                'tumblr'
            );

    	return view('pages.product', compact(
            'product',
            'method',
            'sku',
            'id',
            'share'
        ));
    }

    public function women()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Women Page');

        $women = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

        return view('pages.women', compact('women'));
    }

    public function men()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Men Page');

        $men = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

        return view('pages.men', compact('men'));
    }

    public function kids()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Kids Page');

        $kids = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

        return view('pages.kids', compact('kids'));
    }

    public function bag(Request $request)
    {

        try {
            $bag = new BagService;

            //add or update product item to bag
            if ($request->isMethod('post')) {

                $rules = [
                    'size' => 'required|string|max:255'
                ];

                $validation = $this->validRequest($request, $rules);
                if ($validation->fails()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $validation->errors()
                    ]);
                }

                //remove the item
                if ($request->has('update')) {
                    $rowId = $bag->search($request->input('update'), self::INSTANCE_SHOP);

                    if ($rowId) {
                        $bag->remove($rowId);
                    }
                }

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
                        'description' => $stock->product->content,
                        'currency' => $stock->product->currency,
                        'slug' => $stock->product->slug,
                        'category_id' => $stock->product->category->id
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

            //decrease the quantity
            if ($request->has('count')) {
                $rowId = $bag->search($request->input('count'), self::INSTANCE_SHOP);

                if ($rowId) {
                    $item = $bag->getItemByRowId($rowId);

                    $bag->update($rowId, $request->input('qty'));
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
                $user = $this->getUserActive();
                $wishlistCount = count($user->wishlists);
            }

            $getBags = $bag->get(self::INSTANCE_SHOP);

            $index = 0;
            $bags = [];
            foreach ($getBags as $value) {
                $bags[$index] = $value;
                $index++;
            }

            $subtotal = $bag->subtotal();

            return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'bagCount' => count($bags),
                'bags' => $bags,
                'subtotal' => $subtotal,
                'wishlistCount' => isset($wishlistCount) ? $wishlistCount : null
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function showBagPage()
    {
        $getBags = (new BagService)->get(self::INSTANCE_SHOP);
        $categoryId = [];
        foreach ($getBags as $bag) {
            $categoryId[] = $bag->options->category_id;
        }

        $categoryId = $categoryId[array_rand($categoryId)];

        return view('pages.bag', compact('categoryId'));
    }

    public function review()
    {
      return view('pages.add_review');
    }

    public function page($slug){
        $PageRepository = new PageRepository();

        $result= $PageRepository->getPage($slug);
        $page = $result['page'];
        $status= $result['status'];
        return view('pages.page', compact('page','status'));

    }

    public function help($slug){
        $PageRepository = new PageRepository();

        $result= $PageRepository->getHelp($slug);
        $page = $result['page'];
        $status= $result['status'];
        return view('pages.help', compact('page','status'));

    }

}
