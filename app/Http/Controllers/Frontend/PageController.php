<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\DesignerRepository;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductStockRepository;
use App\Repositories\PageRepository;
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

        $shops = $products->map(function ($entry) {

            return [
                'id' => $entry->id,
                'name' => $entry->name,
                'slug' => $entry->slug,
                'price' => $entry->sell_price,
                'price_before_discount' => $entry->price_before_discount,
                'photo' => $entry->images->first()->photo,
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
            'colorId'
        ));

    }

    public function product($slug, $method = null, $sku = null, $id = null)
    {
        try {
            $exchange = (new CurrencyService)->getCurrentCurrency();
            $product = (new ProductRepository)->getProductBySlug($slug);

            //inject color
            $color = $product->palette;
            $product->color = $color->name;
            $product->color_palette = $color->palette;

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
            $designer = (new ProductRepository)->getDesignerById($product->product_designers_id);
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
                    'tumblr'
                );        

            //get Delivery & Free Returns
            $slug = 'delivery-free-returns';
            $result = (new PageRepository)->getHelp($slug);
            $deliveryReturns = $result['page'][0]['content'];

            //Count Product Categories For Popular Search
            $idProductCategory = $product->product_categories_id;
            (new ProductRepository)->updateCountProductCategory($idProductCategory);

            // Push product ID to session
            session()->push('products.recently_viewed', $product->getKey());

        } catch (Exception $e) {
            return view('pages.not_found')->withErrors($e->getMessage());
        }

    	return view('pages.product', compact(
            'product',
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

        return view('pages.kids', compact('kids','slider'));
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
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
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
        return redirect($result->url);
    }

    public function search(Request $request)
    {
        $product = (new ProductRepository);
        $products = $product->getSearch($request);

        foreach ($request->all() as $key => $value) {
            $products->appends($key, $value);
        }

        $shops = $products->map(function ($entry) {

            return [
                'id' => $entry->id,
                'product_categories_id' => $entry->product_categories_id,
                'name' => $entry->name,
                'slug' => $entry->slug,
                'price' => $entry->sell_price,
                'price_before_discount' => $entry->price_before_discount,
                'photo' => $entry->images->first()->photo,
            ];
        });

        $keyword = $request->input('keyword');

        $productcategory = $product->getSearchCategory($request);
        $category = $request->input('category');
        $subcategory = $request->input('subcategory');
        $filter = request()->query();
        unset($filter['color_id']);
        $colorId = $request->has('color_id') ? $request->input('color_id') : null;

        return view('pages.search', compact(
            'products',
            'shops',
            'keyword',
            'productcategory',
            'category',
            'subcategory',
            'filter',
            'colorId'
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
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getMetaTag(){

        $session = new Session;

        $defaultDesc  = 'rukuka is the original shopping center of indonesian goods made by expert craftsmen in their fields, visit rukuka.com you will be amazed';
        $defaultTitle = 'ruKuKa | how indonesian made really beautiful';

        $currentUrl = explode('/', \URL::current());

        if (count($currentUrl) >= 4) {
            
            if ($currentUrl[3] == 'product') {
                
                $product = DB::table('products')->where('slug','=', $currentUrl[4])->get()->last();

                $specialDesc = $product->name . ' ' . $product->content . ', price: ' . $product->sell_price . ', specification: ' .  $product->technical_specification . ', categories: ' . $product->tags;
                
                $metaTag['meta_tag']['web_meta_tag']['description'] = $specialDesc;

                $metaTag['meta_tag']['sosial_media_meta_tag']['title']       = $product->name;
                $metaTag['meta_tag']['sosial_media_meta_tag']['description'] = $specialDesc;

            }else{

                $metaTag['meta_tag']['web_meta_tag']['description'] = $defaultDesc;

                $metaTag['meta_tag']['sosial_media_meta_tag']['title']       = $defaultTitle;
                $metaTag['meta_tag']['sosial_media_meta_tag']['description'] = $defaultDesc;

            }

        }else{

            $metaTag['meta_tag']['web_meta_tag']['description'] = $defaultDesc;

            $metaTag['meta_tag']['sosial_media_meta_tag']['title']       = $defaultTitle;
            $metaTag['meta_tag']['sosial_media_meta_tag']['description'] = $defaultDesc;

        }

       $session->set('meta_tag', $metaTag['meta_tag']);

    }

}
