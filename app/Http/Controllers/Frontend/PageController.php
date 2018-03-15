<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\DesignerRepository;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductStockRepository;
use App\Repositories\PageRepository;
use App\Repositories\LookbookRepository;
use App\Repositories\BlogRepository;
use Exception;
use Carbon\Carbon;
use App\Services\BagService;
use App\Contact;
use Share;
use DB;
use Validator;
use App\Services\CurrencyService;
use Symfony\Component\HttpFoundation\Session\Session;

class PageController extends BaseController
{
    const INSTANCE_SHOP = 'shopping';

    protected $redirectAfterInsertContact = '/help/contact-us';
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

        $slider = (new SettingRepository())->getSliderByGroup('Homepage');

    	return view('pages.index', compact('home','slider', 'exchange'));
    }

    public function shop(Request $request, $categories, $category, $slug = null, $sale = null)
    {
        if ($categories == 'designers') {
            try{
                $product = (new ProductRepository);
                $products = $product->getProductByDesigner($request, $category);
                $designer = $product->getDesigner();

                //Validate Deleted
                $this->validDelete($designer);
            }
            catch (Exception $e) {
                return view('pages.not_found')->withErrors($e->getMessage());
            }
        } else {
            if ($category == 'all') {
                $products = (new ProductRepository)
                    ->getProductByCategory($request, $categories);
            }else if ($category == 'sale') {
                $products = (new ProductRepository)
                    ->getProductByCategorySale($request, $categories);
            } else {
                if ($sale == 'sale') {
                    $products = (new ProductRepository)
                        ->getProductBySlugCategorySale($request, $slug);
                } else {
                    $products = (new ProductRepository)
                        ->getProductBySlugCategory($request, $slug);
                }
            }
        }

        foreach ($request->all() as $key => $value) {
            $products->appends($key, $value);
        }

        $colorId = $request->has('color_id') ? $request->input('color_id') : null;
        $sortByPrice = $request->input('price');

        $ids = [];
        foreach ($products as $value) {
            $ids[] = $value->id;
        }

        $image = (new ProductRepository)->getProductImage($ids);

        $shops = $products->map(function ($entry) use ($image){

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
                'photo' => $entry->photo,
                'is_new' => $this->date->diffInDays(Carbon::parse($entry->created_at)) <= 7 ? true : false,
            ];
        });

        $recentlyViewed = session()->get('products.recently_viewed');

        $recently = $recentlyViewed ? array_keys(array_flip(array_reverse($recentlyViewed))) : [];

        return view('pages.shop', compact(
            'products',
            'categories',
            'category',
            'slug',
            'designer',
            'shops',
            'sale',
            'recently',
            'colorId',
            'sortByPrice'
        ));

    }

    public function product($slug, $method = null, $sku = null, $id = null)
    {
        try {
            $exchange = (new CurrencyService)->getCurrentCurrency();
            $product = (new ProductRepository)->getProductBySlug($slug);

            //inject currency
            $product->sell_price = $product->sell_price / $exchange->value;
            $product->price_before_discount = $product->price_before_discount <= 0 ? $product->price_before_discount : $product->price_before_discount / $exchange->value;
            $product->currency = $exchange->symbol;

            $sumRating= collect($product->review)->sum('rating');
            $reviews = collect($product->review)->take(3);

            if($sumRating > 0){
                $rating = round($sumRating/count($product->review));
            }

            // Validate Designer Deleted
            $designer = $product->designer;
            $this->validDelete($designer);
            //Validate Product Active
            $this->validActive($product);
            //Validate Product Deleted
            $this->validDelete($product);

            $share = Share::load(route('product', ['slug' => $slug]), $product->name, route('index').'/'.$product->images->first()->photo)
                ->services(
                    'facebook',
                    'gplus',
                    'twitter',
                    'gmail',
                    'pinterest',
                    'whatsapp'
                );

            //Count Product Categories For Popular Search
            $idProductCategory = $product->product_categories_id;
            (new ProductRepository)->updateCountProductCategory($idProductCategory);

            // Push product ID to session
            session()->push('products.recently_viewed', $product->getKey());

        } catch (Exception $e) {
            return view('pages.not_found')->withErrors($e->getMessage());
        }

        $buttonBuy = new \stdClass;
        $buttonBuy->color = $product->palette->name;
        $buttonBuy->color_palette = $product->palette->palette;
        $buttonBuy->content = $product->content;
        $buttonBuy->size_and_fit = $product->size_and_fit;
        $buttonBuy->detail_and_care = $product->detail_and_care;

    	return view('pages.product', compact(
            'product',
            'buttonBuy',
            'method',
            'sku',
            'id',
            'share',
            'rating',
            'deliveryReturns',
            'reviews'
        ));
    }

    public function designer()
    {
        $designers = (new DesignerRepository)->getDesignersAZ();
        $alpabeths = collect($designers)->map(function ($item) {
            return strtolower(substr($item['slug'], 0, 1));
        })->toArray();

        $alpabeths = array_unique($alpabeths);

        return view('pages.designer', compact('designers', 'alpabeths'));
    }

    public function women()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Women Page');

        $women = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

        $slider = (new SettingRepository())->getSliderByGroup('Women');

        return view('pages.women', compact('women','slider'));
    }

    public function men()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Men Page');

        $men = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

        $slider = (new SettingRepository())->getSliderByGroup('Men');

        return view('pages.men', compact('men','slider'));
    }

    public function kids()
    {
        $settings = (new SettingRepository)->getSettingByGroup('Kids Page');

        $kids = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

        $slider = (new SettingRepository())->getSliderByGroup('Kids');

//        return view('pages.kids', compact('kids','slider'));
        return view('errors.404');
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

                if ($stock && $stock->unit > 0) {
                    $product = [
                        'id' => $stock->sku,
                        'name' => $stock->product->name,
                        'qty' => $request->has('qty') ? $request->input('qty') : 1,
                        'price' => $stock->product->sell_price,
                        'options' => [
                            'size' => $stock->size,
                            'color' => $stock->product->palette->name,
                            'photo' => $stock->product->images->first()->photo,
                            'description' => $stock->product->content,
                            'slug' => $stock->product->slug,
                            'product_id' => $stock->product->id,
                            'category_id' => $stock->product->category->id,
                            'product_code' => $stock->product->product_code,
                            'product_stocks_id' => $stock->id,
                            'weight' =>  $stock->product->weight,
                            'length' =>  $stock->product->length,
                            'width' =>  $stock->product->width,
                            'height' =>  $stock->product->height,
                            'diameter' => $stock->product->diameter
                        ]
                    ];
                    $bag->save($product, self::INSTANCE_SHOP);
                } else {
                    throw new Exception("No stock available!", 1);
                }


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
            return $this->error($e->getMessage(), 400);
        }
    }

    public function showBagPage()
    {
        $getBags = (new BagService)->get(self::INSTANCE_SHOP);

        $recentlyViewed = session()->get('products.recently_viewed');

        $recently = $recentlyViewed ? array_keys(array_flip(array_reverse($recentlyViewed))) : [];

        return view('pages.bag', compact('recently'));
    }

    public function page($slug){
        $PageRepository = new PageRepository();

        $result= $PageRepository->getPage($slug);
        if(!$result){
            abort(404);
        }
        $page = $result;
        return view('pages.page', compact('page'));
    }

    public function help($slug){
        $PageRepository = new PageRepository();

        $result= $PageRepository->getHelp($slug);
        if(!$result){
            abort(404);
        }
        $page = $result;
        if($slug == 'contact-us'){
            return view('pages.contact', compact('page'));
        }
        else{
            return view('pages.help', compact('page'));
        }
    }

    public function popup($slug){
        $PageRepository = new PageRepository();

        $result= $PageRepository->getPopup($slug);

        if(!$result){
            abort(404);
        }

        if(!$result->url){
            abort(404);
        }
        return redirect($result->url);
    }

    public function search(Request $request)
    {
        $product = (new ProductRepository);
        $products = $product->getSearch($request);

        foreach ($request->all() as $key => $value) {
            $products->appends($key, $value);
        }

        $ids = [];
        foreach ($products as $value) {
            $ids[] = $value->id;
        }

        $image = (new ProductRepository)->getProductImage($ids);

        $shops = $products->map(function ($entry) use ($image) {

            foreach ($image as $value) {
                if ($entry->id == $value->products_id) {
                    $entry->photo = $value->photo;
                }
            }

            return [
                'id' => $entry->id,
                'product_categories_id' => $entry->product_categories_id,
                'name' => $entry->name,
                'slug' => $entry->slug,
                'price' => $entry->sell_price,
                'price_before_discount' => $entry->price_before_discount,
                'photo' => $entry->photo,
                'is_new' => $this->date->diffInDays(Carbon::parse($entry->created_at)) <= 7 ? true : false,
            ];
        });

        $keyword = $request->input('keyword');

        $productcategory = $product->getSearchCategory($request);
        $category = $request->input('category');
        $subcategory = $request->input('subcategory');
        $filter = request()->query();
        unset($filter['color_id']);
        $colorId = $request->has('color_id') ? $request->input('color_id') : null;
        $sortByPrice = $request->input('price');

        return view('pages.search', compact(
            'products',
            'shops',
            'keyword',
            'productcategory',
            'category',
            'subcategory',
            'filter',
            'colorId',
            'sortByPrice'
        ));
    }

    public function contact (Request $request){
        $this->validate($request, [
            'title' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $contact = new Contact();

            $contact->title = $request->input('title');
            $contact->first_name = $request->input('first_name');
            $contact->last_name = $request->input('last_name');
            $contact->email = $request->input('email');
            $contact->subject = $request->input('subject');
            $contact->message = $request->input('message');
            $contact->save();
            DB::commit();

            return redirect($this->redirectAfterInsertContact)->with(['success' => 'Thank you for contacting us, we will contact back to you as soon as we can.']);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withErrors($e->getMessage());
        }

    }

    public function callBackXendit(Request $request)
    {

        $content = $request->getContent();
        DB::table('callback_payments')->insert(
        ['merchant' => 'xendit', 'response' => $content,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")]
        );

        return $content;
    }

    public function exchange()
    {
        try {
           $exchange = (new CurrencyService)->getCurrentCurrency();
           return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'data' => $exchange
            ]);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    public function getMetaTag(){

        $session = new Session;

        $metaTag = $this->processGetMetaTag(\URL::current());

        $session->set('meta_tag', $metaTag['meta_tag']);

    }

    public function indexLookbook()
    {
        $PageRepository = New PageRepository();
        $BlogRepository = New BlogRepository();

        $lookbook= $PageRepository->getLookbookIndex();
        $category = $BlogRepository->getCategory();
        $title = trans('app.lookbook_title_index');

        return view('pages.lookbook_index', compact('lookbook','title','category'));

    }

    public function getLookbook($slug='')
    {
        try{
            $lookbook = (new LookbookRepository)->getLookbook($slug);

            //Validate Deleted
            $this->validDelete($lookbook);

            $collections = $lookbook->lookbookCollections->map(function ($entry) {
                $ids = [];
                if($entry->lookbookProducts){
                    foreach ($entry->lookbookProducts as $product){
                        $ids[] = $product->products_id;
                    }
                }

                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'title' => $entry->title,
                    'subtitle' => $entry->subtitle,
                    'content' => $entry->content,
                    'photo' => $entry->photo,
                    'order' => $entry->order,
                    'is_active' => $entry->is_active,
                    'product_id'   => json_encode($ids),
                ];
            });

            return view ('pages.lookbook',compact('lookbook','collections'));
        }
        catch (Exception $e) {
            return view('pages.not_found')->withErrors($e->getMessage());
        }

    }


}
