<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Exception;
use DB;
use App\Repositories\UserRepository;
use App\Repositories\ProductStockRepository;
use App\Services\BagService;

class UserController extends BaseController
{
    const INSTANCE_SHOP = 'shopping';

    protected $redirectAfterSaveProfile = '/account/detail';
    protected $redirectAfterSaveCC = '/account/cc';
    protected $redirectAfterSaveAddress = '/account/address';
    protected $redirectAfterSavePassword = '/account/reset-password';
    protected $redirectAfterAddWishlist = '/account/wishlist';
    protected $redirectAfterSaveShippingOption = '/checkout/billing';
    protected $redirectAfterSaveBilling = '/checkout/billing';
    protected $redirectAfterNewShippingAddress = '/checkout/shipping';
    protected $redirectAfterNewCC = '/checkout/billing';
    protected $redirectAfterNewBillingAddress = '/checkout/billing';
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
            'phone_number' => 'required|numeric|max:255',
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

        	return redirect($this->redirectAfterSaveProfile)->with(['success' => 'Update successfully!']);
        } catch (Exception $e) {
        	DB::rollBack();

        	return back()->withErrors($e->getMessage());
        }
    }

    public function showCreditCardPage()
    {
    	$user = $this->getUserActive();

    	$cards = $user->creditCards;

    	$address = $user->address;

    	return view('users.credit_card', compact('user', 'cards', 'address'));
    }

    public function creditCardSave(Request $request)
    {
    	$this->validate($request, [
    		'card_number' => 'required',
    		'expired_date' => 'required',
    		'name_card' => 'required|min:2|max:255',
            'address' => 'required'
    	]);

    	try {
    		DB::beginTransaction();

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
    	$this->validate($request, [
    		'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'postal' => 'required|numeric',
            'address_line' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
        ]);

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
        $user = $this->getUserActive();
        $address = $this->user
            ->setUser($user)
            ->getAddressDefault();

        return view('pages.checkout.shipping_option', compact('address'));
    }

    public function showShippingBillingPage()
    {
        $user = $this->getUserActive();
        $creditcards = $user->creditcards;
        $address = $user->address;
        $defaultAddress = $this->user
            ->setUser($user)
            ->getAddressDefault();

      return view('pages.checkout.shipping_billing', compact(
            'creditcards',
            'address',
            'defaultAddress'
        ));
    }

    public function postShippingOption(Request $request)
    {
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
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'postal' => 'required|numeric',
            'address_line' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
        ]);

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
            $credit = $this->user
                ->getCreditCardById($id);

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

    public function preview()
    {
      return view('pages.checkout.shipping_preview');
    }

}
