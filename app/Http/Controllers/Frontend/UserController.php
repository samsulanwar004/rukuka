<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Exception;
use DB;
use App\Repositories\UserRepository;
use App\Repositories\ProductStockRepository;
use App\Services\BagService;
use App\Services\EmailService;
use App\Repositories\CourierRepository;
use App\Repositories\ProductRepository;
use App\Review;

class UserController extends BaseController
{
    const INSTANCE_SHOP = 'shopping';

    protected $redirectAfterSaveProfile = '/account/detail';
    protected $redirectAfterSaveCC = '/account/cc';
    protected $redirectAfterSaveAddress = '/account/address';
    protected $redirectAfterSavePassword = '/account/reset-password';
    protected $redirectAfterAddWishlist = '/account/wishlist';
    protected $redirectAfterSaveShippingOption = '/checkout/review';
    protected $redirectAfterSaveBilling = '/checkout/review';
    protected $redirectAfterNewShippingAddress = '/checkout/shipping';
    protected $redirectAfterNewCC = '/checkout/billing';
    protected $redirectAfterNewBillingAddress = '/checkout/billing';
    protected $redirectAfterSubmitReview = '/product/';
    private $user;

    public function __construct(UserRepository $user)
    {
    	$this->user = $user;
    }

    public function index()
    {
    	$user = $this->getUserActive();

    	return view('users.index', compact('user'));
    }

    public function showDetailPage()
    {
    	$user = $this->getUserActive();

        return view('users.detail', compact('user'));
    }

    public function update(Request $request)
    {
    	$this->validate($request, [
    		'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
        ]);

        try {
        	DB::beginTransaction();
        	$dob = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
        	$user = $this->getUserActive();

        	$this->user
        		->setFirstName($request->input('first_name'))
        		->setLastName($request->input('last_name'))
        		->setPhone($request->input('phone_number'))
        		->setGender($request->input('gender'))
        		->setDob($dob)
        		->update($user->id);

        	DB::commit();

        	return redirect($this->redirectAfterSaveProfile)->with(['success' => 'Update Successfully!']);
        } catch (Exception $e) {
        	DB::rollBack();

        	return back()->withErrors($e->getMessage());
        }
    }

    public function showCreditCardPage()
    {
    	$user = $this->getUserActive();

    	$cards = $user->creditCards->map(function ($entry) {
            return [
                'id' => $entry->id,
                'card_number' => $this->user->decryptCreditCard($entry->card_number),
                'expired_date' => $entry->expired_date,
                'name_card' => $entry->name_card,
                'is_default' => $entry->is_default,
            ];
        });

    	$address = $user->address;

    	return view('users.credit_card', compact('user', 'cards', 'address'));
    }

    public function creditCardSave(Request $request)
    {
    	$this->validate($request, [
    		'card_number' => 'required|numeric',
    		'expired_date' => 'required',
    		'name_card' => 'required|min:2|max:255',
            'address' => 'required'
    	]);

    	try {
    		DB::beginTransaction();

            if ($request->has('security_code')) {
                $cardNumber = $request->input('card_number');
                $secureCode = $request->input('security_code');

                $cardCode = substr($cardNumber, 13, 3);

                if ($secureCode != $cardCode) {
                    throw new Exception("Security code invalid!", 1);
                }
            }

    		$user = $this->getUserActive();

            $checkCreditCardFound = $user->creditCards;

            $default = 0;
            if(!count($checkCreditCardFound)) {
                $default = 1;
            }

    		$this->user
    			->setUser($user)
                ->setDefault($default)
    			->persistCreditCard($request);

    		DB::commit();

            if ($request->has('checkout')) {
                return redirect($this->redirectAfterSaveBilling);
            }

            if ($request->has('checkout_new_card')) {
                return redirect($this->redirectAfterNewCC);
            }

    		return redirect($this->redirectAfterSaveCC)->with(['success' => 'Save credit card successfully!']);
    	} catch (Exception $e) {
    		DB::rollBack();

        	return back()->withErrors($e->getMessage());
    	}
    }

    public function showAddressPage()
    {
    	$user = $this->getUserActive();

    	$address = $user->address;

    	return view('users.address', compact('user', 'address'));
    }

    public function addressSave(Request $request)
    {
        $rules = [
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'phone_number' => 'required|numeric',
                    'postal' => 'required|numeric',
                    'address_line' => 'required',
                    'city' => 'required',
                    'province' => 'required',
                    'country' => 'required',
                ];

        if ($request->input('country') == 'ID') {
             
             $rules =  $rules + [
                                    'sub_district' => 'required|string|max:255',
                                    'village' => 'required|string|max:255',
                                ];

        }

    	$this->validate($request, $rules);

        try {

        	DB::beginTransaction();

    		$user = $this->getUserActive();

            $checkAddressFound = $user->address;

            $default = 0;
            if(!count($checkAddressFound)) {
                $default = 1;
            }

    		$this->user
    			->setUser($user)
                ->setDefault($default)
    			->persistAddress($request);

    		DB::commit();

            if ($request->has('checkout')) {
                return redirect($this->redirectAfterNewShippingAddress);
            }

            if ($request->has('checkout_address_billing')) {
                return redirect($this->redirectAfterNewBillingAddress);
            }

    		return redirect($this->redirectAfterSaveAddress)->with(['success' => 'Save address book successfully!']);

        } catch (Exception $e) {
        	DB::rollBack();

        	return back()->withErrors($e->getMessage());
        }
    }

    public function defaultCreditCard(Request $request)
    {
    	try {

        	DB::beginTransaction();

    		$user = $this->getUserActive();

    		$this->user
    			->setUser($user)
    			->defaultCreditCard($request);

    		DB::commit();

            return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'credits' => $user->creditCards
            ]);

        } catch (Exception $e) {
        	DB::rollBack();

        	return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function defaultAddress(Request $request)
    {
    	try {

        	DB::beginTransaction();

    		$user = $this->getUserActive();

    		$this->user
    			->setUser($user)
    			->defaultAddress($request);

    		DB::commit();

    		return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'address' => $user->address
            ]);

        } catch (Exception $e) {
        	DB::rollBack();

        	return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function showResetPasswordPage()
    {
    	$user = $this->getUserActive();

    	return view('users.reset_password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
    	$this->validate($request, [
    		'old_password' => 'required|string|min:6',
    		'new_password' => 'required|string|min:6|different:old_password',
            'confirmed' => 'required|string|min:6|same:new_password'
        ]);

        try {
        	DB::beginTransaction();

    		$user = $this->getUserActive();

    		$this->user
    			->setUser($user)
    			->updatePassword($request);

    		DB::commit();

    		return redirect($this->redirectAfterSavePassword)->with(['success' => 'Update password successfully!']);
        } catch (Exception $e) {
        	DB::rollBack();

        	return back()->withErrors($e->getMessage());
        }
    }

    public function showWishlistPage()
    {
        $user = $this->getUserActive();

        return view('users.wishlist', compact('user'));
    }

    public function postWishlist(Request $request)
    {
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

        try {
            DB::beginTransaction();

            $user = $this->getUserActive();

            $stock = (new ProductStockRepository)->getStockBySku($request->input('size'));
            $id = null;
            //remove the item from wishlist
            if ($request->has('update')) {
                $id = $request->input('update');
            }

            $wishlistExist = $this->user->checkWishlistExist($user->id, $stock->id);

            if ($wishlistExist) {
                $id = $wishlistExist->id;
            }

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
                    'slug' => $stock->product->slug
                ],
                'product_stocks_id' => $stock->id
            ];

            $this->user
                ->setUser($user)
                ->persistWishlist($product, $id);

            //remove the item
            if ($request->has('move')) {
                $bag = new BagService;
                $rowId = $bag->search($request->input('move'), self::INSTANCE_SHOP);

                if ($rowId) {
                    $bag->remove($rowId);
                }

                $getBags = $bag->get(self::INSTANCE_SHOP);

                $subtotal = $bag->subtotal();

                $index = 0;
                $bags = [];
                foreach ($getBags as $value) {
                    $bags[$index] = $value;
                    $index++;
                }
            }

            DB::commit();

            return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'bagCount' => isset($bags) ? count($bags) : null,
                'bags' => isset($bags) ? $bags : null,
                'subtotal' => isset($subtotal) ? $subtotal : null,
                'wishlistCount' => count($user->wishlists)
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function wishlistDestroy(Request $request)
    {
        try {
            $user = $this->getUserActive();
            $this->user
                ->wishlistDestroy($request->input('id'));

            return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'wishlistCount' => count($user->wishlists)
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function uploadProfile(Request $request)
    {
        $this->validate($request, [
            'files.*' => 'required|mimes:jpeg,png|dimensions:min_width=100,min_height=200|max:5000'
        ]);

        try {

            $user = $this->getUserActive();

            if ($request->hasFile('files')) {
                $link = $this->user
                    ->setUser($user)
                    ->changeProfile($request);
            }

           return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'data' => $link
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getWishlist()
    {
        try {
            $user = $this->getUserActive();
            $wishlists = collect($user->wishlists)->map(function($entry) {

                return [
                    'id' => $entry->id,
                    'sku' => $entry->stock->sku,
                    'name' => $entry->stock->product->name,
                    'slug' => $entry->stock->product->slug,
                    'price' => $entry->stock->product->sell_price,
                    'currency' => $entry->stock->product->currency,
                    'size' => $entry->content['options']['size'],
                    'color' => $entry->content['options']['color'],
                    'photo' => $entry->content['options']['photo'],
                    'qty' => $entry->content['qty'],
                ];
            });

            return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'wishlists' => $wishlists
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function showShippingAddressPage()
    {
        $user = $this->getUserActive();

        $address = $user->address;

        return view('pages.checkout.shipping_address', compact('address'));
    }

    public function showShippingOptionPage()
    {   
        $bag = new BagService;
        $courierServices = new CourierRepository;

        $user = $this->getUserActive();
        $defaultAddress = $this->user
            ->setUser($user)
            ->getAddressDefault();

        $availableCouriersService = $courierServices->setCheckoutBag($bag->get(self::INSTANCE_SHOP))
                        ->setDestinationAddress($defaultAddress)
                        ->getAvailableCouriers();
        
        return view('pages.checkout.shipping_option', compact('defaultAddress','availableCouriersService'));
    }

    public function showShippingBillingPage()
    {
        try {
          $user = $this->getUserActive();
          $creditcards = $user->creditcards->map(function ($entry) {
              return [
                  'id' => $entry->id,
                  'card_number' => $this->user->decryptCreditCard($entry->card_number),
                  'expired_date' => $entry->expired_date,
                  'name_card' => $entry->name_card,
                  'is_default' => $entry->is_default,
              ];
          });
          $address = $user->address;
          $defaultAddress = $this->user
              ->setUser($user)
              ->getAddressDefault();
        } catch (Exception $e) {
          return back()->withErrors($e->getMessage());
        }


      return view('pages.checkout.shipping_billing', compact(
            'creditcards',
            'address',
            'defaultAddress'
        ));
    }

    public function postShippingOption(Request $request)
    {
        try {
            $bag = new BagService;
            $courierServices = new CourierRepository;

            $user = $this->getUserActive();
            $defaultAddress = $this->user
                ->setUser($user)
                ->getAddressDefault();

            $courir = $courierServices->setCheckoutBag($bag->get(self::INSTANCE_SHOP))
                            ->setDestinationAddress($defaultAddress)
                            ->saveShippingCostChoosed($request->input('shipping'));

            if ($courir['error'] != "000") {
                throw new Exception($courir['message'], 1); 
            }
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return redirect($this->redirectAfterSaveShippingOption);
    }

    public function ccDestroy(Request $request)
    {
        try {
            $user = $this->getUserActive();
            $this->user
                ->ccDestroy($request->input('id'));

            return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'credits' => $user->creditCards
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function addressDestroy(Request $request)
    {
        try {
            $user = $this->getUserActive();
            $this->user
                ->addressDestroy($request->input('id'));

            return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'address' => $user->address
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function addressEdit($id)
    {
        try {
            $user = $this->getUserActive();
            $address = $this->user
                ->getAddressById($id);

            return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'address' => $address
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function addressUpdate(Request $request, $id)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'postal' => 'required|numeric',
            'address_line' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required'
        ];

        if ($request->input('country') == 'ID') {
            
            $rules = $rules + [
                        'sub_district' => 'required',
                        'village' => 'required'
                    ];

        }

        $this->validate($request, $rules);

        try {
            $user = $this->getUserActive();
            $this->user
                ->persistAddress($request, $id);

            return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'address' => $user->address
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function ccEdit($id)
    {
        try {
            $user = $this->getUserActive();
            $creditCard = $this->user
                ->getCreditCardById($id);

            $credit = new \stdClass;
            $credit->id = $creditCard->id;
            $credit->card_number = $this->user->decryptCreditCard($creditCard->card_number);
            $credit->expired_date = $creditCard->expired_date;
            $credit->name_card = $creditCard->name_card;
            $credit->address_id = $creditCard->address_id;

            return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'credit' => $credit
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function ccUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'card_number' => 'required',
            'expired_date' => 'required',
            'name_card' => 'required|min:2|max:255',
            'address' => 'required'
        ]);

        try {
            $user = $this->getUserActive();
            $this->user
                ->persistCreditCard($request, $id);

            return response()->json([
                'status' => 'ok',
                'message' => 'success',
                'credits' => $user->creditCards
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }
    }

    public function showReviewPage()
    {
        $user = $this->getUserActive();
        $bag = new BagService;
        // $creditCard = $this->user
        //     ->setUser($user)
        //     ->getCreditCardDefault();

        // $defaultCreditcard = new \stdClass;
        // $defaultCreditcard->id = $creditCard->id;
        // $defaultCreditcard->card_number = $this->user->decryptCreditCard($creditCard->card_number);
        // $defaultCreditcard->expired_date = $creditCard->expired_date;
        // $defaultCreditcard->name_card = $creditCard->name_card;
        // $defaultCreditcard->first_name = $creditCard->address->first_name;
        // $defaultCreditcard->company = $creditCard->address->company;
        // $defaultCreditcard->address_line = $creditCard->address->address_line;
        // $defaultCreditcard->city = $creditCard->address->city;
        // $defaultCreditcard->postal = $creditCard->address->postal;
        // $defaultCreditcard->country = $creditCard->address->country;
        // $defaultCreditcard->phone_number = $creditCard->address->phone_number;

        $shippingCost = (new CourierRepository)->getSavedSessionShippingChoosed();

        $defaultAddress = $this->user
            ->setUser($user)
            ->getAddressDefault();
        $bag->get(self::INSTANCE_SHOP);

        $total = $bag->subtotal();

        return view('pages.checkout.shipping_preview', compact(
            // 'defaultCreditcard',
            'defaultAddress',
            'shippingCost',
            'total'
        ));
    }

    public function history()
    {
        
        $user = $this->getUserActive();

        $onPaid = $user->orders->filter(function ($entry) {
            return $entry->payment_status == 0 && $entry->order_status == 0;
        });

        $onSent = $user->orders->filter(function ($entry) {
            return $entry->payment_status == 1 && $entry->order_status == 0;
        });

        $onReceived = $user->orders->filter(function ($entry) {
            return $entry->order_status == 1;
        });

        $onDone = $user->orders->filter(function ($entry) {
            return $entry->order_status == 2;
        });

        $onCanceled = $user->orders->filter(function ($entry) {
            return $entry->order_status == 3;
        });

        return view('users.history', compact(
            'user',
            'onPaid',
            'onSent',
            'onReceived',
            'onDone',
            'onCanceled',
            'status',
            'status_message'

        ));
    }

    public function review($slug)
    {
        $user = $this->getUserActive();
        $product = (new ProductRepository)->getProductBySlug($slug);
        return view('pages.add_review',compact('user','product'));
    }

    public function postReview(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'review' => 'required|string',
            'location' => 'string|string',
            'star' => 'required',
        ]);

        try {
            $user = $this->getUserActive();
            (new UserRepository)->setUser($user)->saveReview($request);

            return redirect($this->redirectAfterSubmitReview.$request->input('slug'))->with(['success' => 'Thank you for submit your review']);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withErrors($e->getMessage());
        }

    }

    public function getReviewAjax(Request $request)
    {

        $review = '';
        $loader = '';
        $id_review = $request->id_review;
        $id_product = $request->id_product;
        $reviews = Review::select('reviews.*','users.first_name','users.last_name')
            ->where('products_id',$id_product)
            ->where('is_approved',1)
            ->where('reviews.id','<',$id_review)
            ->leftJoin('users', 'reviews.users_id', '=', 'users.id')
            ->orderBy('id', 'desc')
            ->take(3)->get()
            ->toArray();
        if(count($reviews))
        {
            foreach($reviews as $data)
            {
                if (strlen($data['review'])>120){
                    $showless = '<a onclick="less('. $data['id'] .')" class="uk-text-bold uk-text-small"> show more</a>';
                }

                if ($data['comment']) {
                    $comment = '
                                <div class="uk-card uk-card-body uk-margin-small-top uk-text-small" style="background: #EEEEEE">
                                    <div class="uk-text-bold uk-text-center">
                                        Response From rukuka
                                    </div>
                                    <div class="uk-text-left uk-text-small uk-margin-small-top">
                                      '. $data['review'].'
                                    </div>
                                </div>
                    ';
                }

                $review .= '      
                <div class="uk-width-1-3@m">
                    <div class="uk-card uk-card-border uk-card-small">
                        <div class="uk-card-body" style="min-height: 250px">
                                <div class="uk-flex uk-flex-center">
                                  <div class="stars-product uk-margin-remove uk-text-center">
                                      <input disabled type="radio" name="star-'. $data['id'] .'" class="star-1" value="1" '.($data['rating'] == 1 ? 'checked':'').'/>
                                      <input disabled type="radio" name="star-'. $data['id'] .'" class="star-2" value="2" '.($data['rating'] == 2 ? 'checked':'').'/>
                                      <input disabled type="radio" name="star-'. $data['id'] .'" class="star-3" value="3" '.($data['rating'] == 3 ? 'checked':'').'/>
                                      <input disabled type="radio" name="star-'. $data['id'] .'" class="star-4" value="4" '.($data['rating'] == 4 ? 'checked':'').'/>
                                      <input disabled type="radio" name="star-'. $data['id'] .'" class="star-5" value="5" '.($data['rating'] == 5 ? 'checked':'').'/>
                                      <span></span>
                                  </div>
                                </div>
                                <div class="uk-text-bold uk-text-center uk-margin-top-small">
                                    '. $data['title'] .'
                                </div>
                                <div class="uk-text-small uk-text-muted uk-text-center">
                                    '.date("F j, Y", strtotime($data['created_at'])).'
                                </div>
                                    <div class="uk-text-left uk-margin-small-top">
                                    <p class="uk-hidden" id=more-'. $data['id'] .'>'. $data['review'] .'
                                        <a onclick="more('. $data['id'] .')" class="uk-text-bold uk-text-small"> show less</a>
                                    </p>
                                    <p id="less-'. $data['id'] .'">'. str_limit($data['review'],120) .' 
                                        '.$showless.'
                                    </p>
                                </div>
                                <div class="uk-text-small uk-text-left uk-margin-small-top">
                                    '.ucfirst($data['first_name']).''." ".''.ucfirst($data['last_name']).' 
                                </div>
                                <div class="uk-text-small uk-text-muted uk-text-left">
                                     '.$data['location'].'
                                </div>
                                '.$comment.'
                        </div>
                    </div>
                </div>
          ';
            }
            $loader .= '
                            <div id="remove-row">
                                <h2>
                                        <a onclick="myFunction('. $reviews[count($reviews)-1]['id'] .','.$reviews[count($reviews)-1]['products_id'].')" id="btn-more" class="uk-button uk-button-default" > SEE MORE REVIEW </a>
                                </h2>
                            </div>
                        ';

            $response = array('review' => $review, 'loader' => $loader, 'count' => count($reviews));
            echo json_encode($response);
        }
    }

    public function postFinalPage(Request $request)
    {  
        try {
            $data = $request->all();
            $signature1 = $data["order"]["signature"];
            $secret = config('common.order_key_signature');
            $signature2 = sha1($data['request']['amount'].$secret);


            if($signature1 == $signature2)
            {
                $external_id = $data["order"]["order_code"]; 
                $token_id = $data['response']['id'];
                $amount = $data['request']['amount'];
                $capture_options['authentication_id'] = $data['response']['authentication_id'];

                $curl = curl_init();

                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $secret_api_key = config('common.xendit_secret_key');
                $server_domain = 'https://api.xendit.co';

                $end_point = $server_domain.'/credit_card_charges';

                $data['external_id'] = $external_id;
                $data['token_id'] = $token_id;
                $data['amount'] = $amount;

                if (!empty($capture_options['authentication_id'])) {
                    $data['authentication_id'] = $capture_options['authentication_id'];
                }

                if (!empty($capture_options['card_cvn'])) {
                    $data['card_cvn'] = $capture_options['card_cvn'];
                }

                if (!empty($capture_options['capture'])) {
                    $data['capture'] = $capture_options['capture'];
                }

                $payload = json_encode($data);

                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_USERPWD, $secret_api_key.":");
                curl_setopt($curl, CURLOPT_URL, $end_point);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($curl);
                curl_close($curl);

                $responseObject = json_decode($response, true);
                //return $responseObject;

                $response_cc = $responseObject;
                 if(!isset($response_cc["capture_amount"]))
                 {
                    $response_cc["capture_amount"] = null ;
                 }
                 if(!isset($response_cc["failure_reason"]))
                 {
                    $response_cc["failure_reason"] = null ;
                 }

                DB::table('response_payments')->insert(
                    [
                        'order_code'    => $data["order"]["order_code"],
                        'response_json' => $response, 
                        'created_at'    => date("Y-m-d H:i:s"),
                        'updated_at'    => date("Y-m-d H:i:s")
                    ]
                );
                if($response_cc["status"] == "CAPTURED")
                {
                    $user = $this->getUserActive();
                    $order = (new OrderRepository)->getOrderbyOrderCode($data["order"]["order_code"]);
                    $order->payment_status = 1;
                    $order->payment_name = $data["order"]["card_holder"];
                    $order->pending_reason = 'already paid';
                    $order->update();

                    $message = "Charge is successfully captured and the funds will be settled according to the settlement schedule.";

                    //EMAILSENT
                    //sent invoice unpaid to buyer
                    $emailService = (new EmailService);
                    $emailService->sendInvoicePaid($user,$order);
                }

                if($response_cc["status"] == "AUTHORIZED") // MASIH RAGU DI GANTI STATUSNYA GA
                {
                    DB::table('orders')
                    ->where('order_code', $data["order"]["order_code"])
                    ->update(['payment_status' => 1,'payment_status' => 1,'updated_at' => date("Y-m-d H:i:s")]);

                     $message = "Charge is successfully authorized.";
                }

                if($response_cc["status"] == "FAILED")
                {
                   if($response_cc["failure_reason"] == "EXPIRED_CARD")
                    {
                        $message = "The card you are trying to capture is expired. Ask your customer for a different card";
                    }
                    elseif($response_cc["failure_reason"] == "CARD_DECLINED")
                    {
                        $message = "The card you are trying to capture has been declined by the bank. Ask your customer for a different card";
                    }
                    elseif($response_cc["failure_reason"] == "INSUFFICIENT_BALANCE")
                    {
                        $message = "The card you are trying to capture does not have enough balance to complete the capture";
                    }
                    elseif($response_cc["failure_reason"] == "STOLEN_CARD")
                    {
                        $message = "The card you are trying to capture has been marked as stolen. Ask your customer for a different card";
                    }
                    elseif($response_cc["failure_reason"] == "INACTIVE_CARD")
                    {
                        $message = "The card you are trying to capture is inactive. Ask your customer for a different card";
                    }
                    elseif($response_cc["failure_reason"] == "INVALID_CVN")
                    {
                        $message = "The cvn that being submitted is not correct";
                    }
                    elseif($response_cc["failure_reason"] == "PROCESSOR_ERROR")
                    {
                        $message = "The charge failed because there's an integration issue between card processor and the bank. Contact us if you encounter this issue";
                    }
                    else
                    {
                        $message = "error";
                    }

                    
                }
                
                 
                // DB::table('payments')->insert(
                //     [
                //         'user_id' => $data["order"]["user_id"],
                //         'authorized_amount' => $response_cc["authorized_amount"],
                //         'business_id' => $response_cc["business_id"],
                //         'external_id' => $data["order"]["order_code"],
                //         'merchant_id' => $response_cc["merchant_id"],
                //         'merchant_reference_code' => $response_cc["merchant_reference_code"],
                //         'masked_card_number' => $response_cc["masked_card_number"],
                //         'charge_type' => $response_cc["charge_type"],
                //         'card_brand' => $response_cc["card_brand"],
                //         'card_type' => $response_cc["card_type"],
                //         'status' => $response_cc["status"],
                //         'eci' => $response_cc["eci"],
                //         'capture_amount' => $response_cc["capture_amount"],
                //         'status_id' => $response_cc["id"],
                //         'created'=> $response_cc["created"]
                //     ]
                // );
              
              
             }
             else 
             {
                $message = "error" ;
             }
             session(['payment_status' => $response_cc["status"]]);
             session(['payment_message' => $message]);
             
            return $responseObject;       
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ],400);
        }       
    }

}
