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
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use Exception;
use Carbon\Carbon;
use App\Services\BagService;
use App\Contact;
use Share;
use DB;
use Validator;
use App\Services\CurrencyService;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Cache;
use App\Jobs\ProcessDecreaseStock;
use App\Services\EmailService;

class PageController extends BaseController
{
    const INSTANCE_SHOP = 'shopping';
    const SETTING_HOME_CACHE = 'setting.home.cache';
    const SETTING_MEN_CACHE = 'setting.men.cache';
    const SETTING_WOMEN_CACHE = 'setting.women.cache';
    const SLIDER_HOME_CACHE = 'slider.home.cache';
    const SLIDER_MEN_CACHE = 'slider.men.cache';
    const SLIDER_WOMEN_CACHE = 'slider.women.cache';
    const DESIGNER_CACHE = 'designer.cache';

    protected $redirectAfterInsertContact = '/help/contact-us';
    private $date;

    public function __construct()
    {
        $this->date = Carbon::now('Asia/Jakarta');
    }

    public function index()
    {
        if (Cache::has(self::SETTING_HOME_CACHE)) {
            $settings = Cache::get(self::SETTING_HOME_CACHE);
        } else {
            $settings = (new SettingRepository)->getSettingByGroup('Home Page');

            $expiresAt = Carbon::now()->addMinutes(60);

            Cache::put(self::SETTING_HOME_CACHE, $settings, $expiresAt);
        }

        $home = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

        if (Cache::has(self::SLIDER_HOME_CACHE)) {
            $slider = Cache::get(self::SLIDER_HOME_CACHE);
        } else {
            $slider = (new SettingRepository())->getSliderByGroup('Homepage');

            $expiresAt = Carbon::now()->addMinutes(60);

            Cache::put(self::SLIDER_HOME_CACHE, $slider, $expiresAt);
        }

    	return view('pages.index', compact('home','slider', 'exchange'));
    }

    public function shop(Request $request, ProductRepository $product)
    {
        try {

            //Session view count
            if ($request->session()->has('view.session') && !$request->has('view')) {
                $request->merge(['view' => $request->session()->get('view.session')]);
            }

            //get list category product
            if($request->has('designer')) {
                $categoryArr = $product->getCategoryProductDesigner($request);
            }else{
                $categoryArr = $product->getCategoryProduct($request);
            }

            if(count($categoryArr) != 0){
                $categoryArray = [];
                foreach ($categoryArr as $value)
                    $categoryArray[] = $value->category_name;
            }
            else{
                $categoryArray = [];
            }

            $categoryCount = $categoryArr->mapWithKeys(function ($item) {
                return [$item->category_name => $item->product_total];
            });
            //end get list category product 

            // get list color product
            $colorArr = $product->getColorByProduct($request);

            if(count($colorArr) != 0){
                $colorArray = [];
                foreach ($colorArr as $value)
                    $colorArray[] = $value->color_name;
            }
            else{
                $colorArray = [];
            }
            // end get list color product

            // get list size product
            $sizeArr = $product->getSizeByProduct($request);

            if(count($sizeArr) != 0){
                $sizeArray = [];
                foreach ($sizeArr as $value)
                    $sizeArray[] = $value->size;
            }
            else{
                $sizeArray = [];
            }
            // end get list size product

            $products = $product->getProductByMenu($request);

            foreach ($request->all() as $key => $value) {
                $products->appends($key, $value);
            }

            $colorId = $request->has('color_id') ? $request->input('color_id') : null;
            $sortByPrice = $request->input('price');
            $sortByNew = $request->input('sort');
            $sortByPopular = $request->input('popular');
            $sortByDiscount = $request->input('discount');

            //get wishlist
            $wishlists = [];
            if ($user = $this->getUserActive()) {
                $wishlists = (new UserRepository)->getWishlistByUserId($user->id);
                $wishlists = $wishlists->map(function($entry) {
                    return $entry->id;
                })->toArray();
            }

            $shops = $products->map(function ($entry) use ($request, $wishlists) {

                $like = in_array($entry->id, $wishlists) ? true : false;

                return [
                    'id' => $entry->id,
                    'name' => $entry->name,
                    'slug' => $entry->gender != 'unisex' ? $entry->slug : $entry->slug.'?menu='.$request->input('menu'),
                    'price' => $entry->sell_price,
                    'price_before_discount' => $entry->price_before_discount,
                    'photo' => $entry->photo ? str_replace('original', 'medium', $entry->photo) : $entry->photo,
                    'is_new' => $this->date->diffInDays(Carbon::parse($entry->created_at)) <= 7 ? true : false,
                    'designer_name' => $entry->designer_name,
                    'designer_slug' => $entry->designer_slug,
                    'like' => $like
                ];
            });

            $recentlyViewed = session()->get('products.recently_viewed');

            $recently = $recentlyViewed ? array_keys(array_flip(array_reverse($recentlyViewed))) : [];

            $categories = $request->input('menu');
            $category = $request->input('parent');
            $slug = $request->input('category');
            $view = $request->has('view') ? $request->input('view') : 36;
            $onSize = $request->has('size') ? $request->input('size') : '';

            // put session view count
            $request->session()->put('view.session', $view);

            // put session menu
            $request->session()->put('menu.session', $categories);

            // when parent designer
            if ($request->has('designer')) {
                $designer = $product->getDesigner();
            }

            if($request->has('range')) {
                $range = $request->input('range');
                $rangeArr = explode('-',$range);
                $range = [
                    'price_min' => $rangeArr[0],
                    'price_max' => $rangeArr[1],
                    ];
            }

        } catch (Exception $e) {
            logger($e->getMessage());
            return abort(404);
        }

        return view('pages.shop', compact(
            'products',
            'categories',
            'category',
            'slug',
            'designer',
            'shops',
            'sortByDiscount',
            'recently',
            'colorId',
            'sortByPrice',
            'categoryArray',
            'colorArray',
            'sortByNew',
            'sortByPopular',
            'view',
            'sizeArray',
            'onSize',
            'range',
            'categoryCount'
        ));

    }

    public function product(Request $request, $slug, $method = null, $sku = null, $id = null)
    {
        try {
            $exchange = (new CurrencyService)->getCurrentCurrency();
            $product = (new ProductRepository)->getProductBySlug($slug);

            //inject currency
            $product->sell_price = $product->sell_price / $exchange->value;
            $product->price_before_discount = $product->price_before_discount <= 0 ? $product->price_before_discount : $product->price_before_discount / $exchange->value;
            $product->currency = $exchange->symbol;

            if ($request->has('menu')) {
                $product->gender = $request->input('menu');
            }

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

            //Count Product Categories For Popular Search
            $idProduct = $product->id;
            (new ProductRepository)->updateCountProducts($idProduct);

            // Push product ID to session
            session()->push('products.recently_viewed', $product->getKey());

        } catch (Exception $e) {
            return view('pages.not_found')->withErrors($e->getMessage());
        }

        $buttonBuy = new \stdClass;
        $buttonBuy->id = $product->id;
        $buttonBuy->color = $product->palette->name;
        $buttonBuy->color_palette = $product->palette->palette;
        $buttonBuy->content = $product->content;
        $buttonBuy->size_and_fit = $product->size_and_fit;
        $buttonBuy->detail_and_care = $product->detail_and_care;
        $buttonBuy->is_preorder = $product->is_preorder;
        $buttonBuy->preorder_day = $product->preorder_day;

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
        if (Cache::has(self::DESIGNER_CACHE)) {
            $designers = Cache::get(self::DESIGNER_CACHE);
        } else {
            $designers = (new DesignerRepository)->getDesignersAZ();

            $expiresAt = Carbon::now()->addMinutes(60);

            Cache::put(self::DESIGNER_CACHE, $designers, $expiresAt);
        }

        $alpabeths = collect($designers)->map(function ($item) {
            return strtolower(substr($item['slug'], 0, 1));
        })->toArray();

        $alpabeths = array_unique($alpabeths);

        $menu = request()->has('menu') ? request()->input('menu') : '';

        return view('pages.designer', compact('designers', 'alpabeths', 'menu'));
    }

    public function women(Request $request)
    {

        if (Cache::has(self::SETTING_WOMEN_CACHE)) {
            $settings = Cache::get(self::SETTING_WOMEN_CACHE);
        } else {
            $settings = (new SettingRepository)->getSettingByGroup('Women Page');

            $expiresAt = Carbon::now()->addMinutes(60);

            Cache::put(self::SETTING_WOMEN_CACHE, $settings, $expiresAt);
        }

        $women = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

        if (Cache::has(self::SLIDER_WOMEN_CACHE)) {
            $slider = Cache::get(self::SLIDER_WOMEN_CACHE);
        } else {
            $slider = (new SettingRepository())->getSliderByGroup('Women');

            $expiresAt = Carbon::now()->addMinutes(60);

            Cache::put(self::SLIDER_WOMEN_CACHE, $slider, $expiresAt);
        }

        $menu = 'womens';

        $request->session()->put('menu.session', $menu);

        return view('pages.women', compact('women','slider', 'menu'));
    }

    public function men(Request $request)
    {

        if (Cache::has(self::SETTING_MEN_CACHE)) {
            $settings = Cache::get(self::SETTING_MEN_CACHE);
        } else {
            $settings = (new SettingRepository)->getSettingByGroup('Men Page');

            $expiresAt = Carbon::now()->addMinutes(60);

            Cache::put(self::SETTING_MEN_CACHE, $settings, $expiresAt);
        }

        $men = collect($settings)->mapWithKeys(function ($item) {
            return [$item['name'] => $item['content']];
        })->toArray();

        if (Cache::has(self::SLIDER_MEN_CACHE)) {
            $slider = Cache::get(self::SLIDER_MEN_CACHE);
        } else {
            $slider = (new SettingRepository())->getSliderByGroup('Men');

            $expiresAt = Carbon::now()->addMinutes(60);

            Cache::put(self::SLIDER_MEN_CACHE, $slider, $expiresAt);
        }

        $menu = 'mens';

        $request->session()->put('menu.session', $menu);

        return view('pages.men', compact('men','slider', 'menu'));
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
                            'photo' => $stock->product->images->first()->photo ? str_replace('original', 'small', $stock->product->images->first()->photo) : $stock->product->images->first()->photo,
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
                            'diameter' => $stock->product->diameter,
                            'preorder' => $stock->product->is_preorder == 1 ? $stock->product->preorder_day : null,
                            'unit' => $stock->unit,
                            'price_sale' => $stock->product->price_before_discount
                        ]
                    ];

                    $rowId = $bag->search($request->input('size'), self::INSTANCE_SHOP);
                    
                    if ($rowId) {
                        $item = $bag->getItemByRowId($rowId);

                        if ($item->qty >= $item->options->unit) {
                            throw new Exception("Size ".$item->options->size." out of stock", 1); 
                        }
                    } else {
                        if ($product['qty'] > $stock->unit) {
                            throw new Exception("Size ".$product['options']['size']." stock less than ".$product['qty'], 1); 
                        }
                    }
                    
                    $bag->save($product, self::INSTANCE_SHOP);

                } else {
                    throw new Exception("Out of stock!", 1);
                }


            }

            //increment the quantity
            if ($request->has('increment')) {

                $rowId = $bag->search($request->input('increment'), self::INSTANCE_SHOP);

                if ($rowId) {
                    $item = $bag->getItemByRowId($rowId);

                    if ($item->qty >= $item->options->unit) {
                        throw new Exception("Size ".$item->options->size." out of stock", 1); 
                    }

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

                    if ($request->input('qty') > $item->options->unit) {
                        throw new Exception("Size ".$item->options->size." out of stock", 1); 
                    }

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
            $discount = 0;
            foreach ($getBags as $value) {
                $bags[$index] = $value;
                $index++;
                $discount += $value->options['price_sale'] > $value->price ? ($value->options['price_sale'] - $value->price) * $value->qty : 0;
            }

            $subtotal = $bag->subtotal();

            return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'bagCount' => count($bags),
                'bags' => $bags,
                'subtotal' => $subtotal,
                'wishlistCount' => isset($wishlistCount) ? $wishlistCount : null,
                'discount' => $discount
            ]);

        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400, true);
        }
    }

    public function showBagPage(Request $request)
    {
        $bags = (new BagService)->get(self::INSTANCE_SHOP);

        $discount = 0;
        if ($bags) {
            foreach ($bags as $value) {
                $discount += $value->options['price_sale'] > $value->price ? ($value->options['price_sale'] - $value->price) * $value->qty : 0;
            }
        }

        $recentlyViewed = session()->get('products.recently_viewed');

        $recently = $recentlyViewed ? array_keys(array_flip(array_reverse($recentlyViewed))) : [];

        if ($request->session()->has('menu.session')) {
            $menu = $request->session()->get('menu.session');
        } else {
            $menu = 'womens';
        }

        return view('pages.bag', compact('recently', 'bags', 'discount', 'menu'));
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

        //Session view count
        if ($request->session()->has('view.session') && !$request->has('view')) {
            $request->merge(['view' => $request->session()->get('view.session')]);
        }

        $product = (new ProductRepository);
        $products = $product->getSearch($request);

        foreach ($request->all() as $key => $value) {
            $products->appends($key, $value);
        }

        //get wishlist
        $wishlists = [];
        if ($user = $this->getUserActive()) {
            $wishlists = (new UserRepository)->getWishlistByUserId($user->id);
            $wishlists = $wishlists->map(function($entry) {
                return $entry->id;
            })->toArray();
        }

        $shops = $products->map(function ($entry) use ($request, $wishlists) {

            $like = in_array($entry->id, $wishlists) ? true : false;

            return [
                'id' => $entry->id,
                'product_categories_id' => $entry->product_categories_id,
                'name' => $entry->name,
                'slug' => $entry->gender != 'unisex' ? $entry->slug : $entry->slug.'?menu='.$request->input('menu'),
                'price' => $entry->sell_price,
                'price_before_discount' => $entry->price_before_discount,
                'photo' => $entry->photo ? str_replace('original', 'medium', $entry->photo) : $entry->photo,
                'is_new' => $this->date->diffInDays(Carbon::parse($entry->created_at)) <= 7 ? true : false,
                'designer_name' => $entry->designer_name,
                'designer_slug' => $entry->designer_slug,
                'like' => $like
            ];
        });

        $keyword = $request->input('keyword');
        $sortByPrice = $request->input('price');
        $sortByNew = $request->input('sort');
        $sortByPopular = $request->input('popular');
        $sortByDiscount = $request->input('discount');
        $navigation = $request->input('menu');
        $view = $request->has('view') ? $request->input('view') : 36;
        $request->session()->put('view.session', $view);
        
        // put session menu
        $request->session()->put('menu.session', $navigation);

        if(count($products) == 0){
            return view('pages.search_404', compact('keyword','navigation'));
        }
        else{
            return view('pages.search', compact(
                'products',
                'navigation',
                'shops',
                'keyword',
                'sortByPrice',
                'sortByPopular',
                'sortByNew',
                'sortByDiscount',
                'view'
            ));
        }
    }

    public function contact (Request $request){
        $this->validate($request, [
            'title' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required|recaptcha'
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

            //send notification
            $users = config('common.admin.users_id');
            $message = 'New message';
            $module = 'contacts';
            $this->notificationforAdmin($users, $message, $module);

            return redirect($this->redirectAfterInsertContact)->with(['success' => 'Thank you for contacting us, we will contact back to you as soon as we can.']);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withErrors($e->getMessage());
        }

    }

    public function callBackXendit(Request $request)
    {

        try {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $datas = json_decode(file_get_contents("php://input"));

                if ($datas->status == 'PAID' || $datas->status == 'CAPTURED') {
                    $message = 'already paid';
                    $order = (new OrderRepository)->getOrderByPaymentCode($datas->id);
                    
                    if ($order && $order->payment_status != 1) {
                        $order->payment_status = 1;
                        $order->pending_reason = $message;
                        $order->payment_response = json_encode($datas);
                        $order->update();

                        //create notification
                        $users = config('common.admin.users_id');
                        $module = 'orders';
                        (new PaymentRepository)->notificationforAdmin($users, $order->order_code.' '.$message, $module);

                        //EMAILSENT
                        //sent invoice paid to buyer
                        $emailService = (new EmailService);
                        $emailService->sendInvoicePaid($order);
                        //EMAILSENTADMIN
                        $emailService->sendNotificationInvoicePaidToAdmin($order);

                        //decrease stock
                        ProcessDecreaseStock::dispatch($order)
                            ->onConnection(config('common.queue_active'))
                            ->onQueue(config('common.queue_list.processing'));
                    }
                }
            }

            return $this->success();
        } catch (Exception $e) {
            return $this->error($e);
        }
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

    public function getLookbook()
    {
        $LookbookRepository = New LookbookRepository();
        $BlogRepository = New BlogRepository();

        $lookbook= $LookbookRepository->getLookbook();
        $category = $BlogRepository->getCategory();
        $title = trans('app.lookbook_title_index');

        return view('pages.lookbook', compact('lookbook','title','category'));

    }

    public function getLookbookCollection($lookbook_slug='')
    {

        try{
            $lookbook = (new LookbookRepository)->getLookbookCollection($lookbook_slug);

            //Validate Deleted
            $this->validDelete($lookbook);
            if($lookbook == null){
                abort(404);
            }

            //Validate Deleted
            $this->validDelete($lookbook);

            return view ('pages.lookbook_collection',compact('lookbook'));
        }
        catch (Exception $e) {
            return view('pages.not_found')->withErrors($e->getMessage());
        }

    }


    public function getLookbookCollectionProduct($lookbook_slug='',$collection_slug='')
    {
        try{
            $lookbook = (new LookbookRepository)->getLookbookCollection($lookbook_slug);
            //Validate Deleted
            $this->validDelete($lookbook);
            if($lookbook == null){
                abort(404);
            }

            $lookbookCollection = (new LookbookRepository)->getLookbookProduct($collection_slug);
            //Validate Deleted
            $this->validDelete($lookbookCollection);
            if($lookbookCollection == null){
                abort(404);
            }

            $ids = [];
            if($lookbookCollection->lookbookProducts){
                foreach ($lookbookCollection->lookbookProducts as $product){
                    $ids[] = $product->products_id;
                }
            }
            $collections =  [
                'id' => $lookbookCollection->id,
                'name' => $lookbookCollection->name,
                'title' => $lookbookCollection->title,
                'subtitle' => $lookbookCollection->subtitle,
                'content' => $lookbookCollection->content,
                'photo' => $lookbookCollection->photo,
                'order' => $lookbookCollection->order,
                'is_active' => $lookbookCollection->is_active,
                'product_id' => json_encode($ids),
            ];

            return view ('pages.lookbook_product',compact('lookbookCollection','collections'));
        }
        catch (Exception $e) {
            return view('pages.not_found')->withErrors($e->getMessage());
        }

    }

    public function getProductByAjax($code)
    {
        $product = (new ProductRepository)->getProductBySku($code);
        $preorder = $product->is_preorder == 1 ? $product->preorder_day.' days' : '-';
        echo "
        <p>
            <table>
                <tr><td>Designer</td><td>:</td><td>".$product->designer_name."</td></tr>
                <tr><td>Name</td><td>:</td><td>".$product->name."</td></tr>
                <tr><td>Color</td><td>:</td><td>".$product->color."</td></tr>
                <tr><td>SKU</td><td>:</td><td>".$product->sku."</td></tr>
                <tr><td>Size</td><td>:</td><td>".$product->size."</td></tr>
                <tr><td>Preorder</td><td>:</td><td>".$preorder."</td></tr>
                <tr><td>Photo</td><td>:</td><td><img width='500px' src='".uploadCDN(str_replace('original', 'small', $product->photo))."'></td></tr>
            </table>
        </p>";
    }


}
