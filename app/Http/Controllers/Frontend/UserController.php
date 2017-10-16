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

    public function saveCreditCard(Request $request)
    {
    	$this->validate($request, [
    		'card_number' => 'required',
    		'expired_date' => 'required',
    		'name_card' => 'required|min:2|max:255'
    	]);

    	try {
    		DB::beginTransaction();

    		$user = $this->getUserActive();

    		$this->user
    			->setUser($user)
    			->persistCreditCard($request); 

    		DB::commit();
    		
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

    public function saveAddress(Request $request)
    {
    	$this->validate($request, [
    		'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'postal' => 'required|numeric',
        ]);

        try {

        	DB::beginTransaction();

    		$user = $this->getUserActive();

    		$this->user
    			->setUser($user)
    			->persistAddress($request); 

    		DB::commit();
    		
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
    		
    		return redirect($this->redirectAfterSaveCC)->with(['success' => 'Save default credit card successfully!']);
        	
        } catch (Exception $e) {
        	DB::rollBack();

        	return back()->withErrors($e->getMessage());
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
    		
    		return redirect($this->redirectAfterSaveAddress)->with(['success' => 'Save default address successfully!']);
        	
        } catch (Exception $e) {
        	DB::rollBack();

        	return back()->withErrors($e->getMessage());
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

        $wishlists = collect($user->wishlists)->map(function($entry) {

            return [
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

        return view('users.wishlist', compact('user', 'wishlists'));
    }

    public function wishlist(Request $request)
    {
        $this->validate($request, [
            'size' => 'required|string|max:255'
        ]);

        try {
            DB::beginTransaction();

            $user = $this->getUserActive();

            $stock = (new ProductStockRepository)->getStockBySku($request->input('size'));

            $wishlistExist = $this->user->checkWishlistExist($user->id, $stock->id);

            if ($wishlistExist) {
                throw new Exception("Item have been added", 1);   
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
                    'description' => $stock->product->content
                ],
                'product_stocks_id' => $stock->id
            ];

            $this->user
                ->setUser($user)
                ->persistWishlist($product);

            //remove the item
            if ($request->has('move')) {
                $bag = new BagService;
                $rowId = $bag->search($request->input('move'), self::INSTANCE_SHOP);

                if ($rowId) {
                    $bag->remove($rowId);
                }
            }

            DB::commit();

            return redirect($this->redirectAfterAddWishlist)->with(['success' => 'Add wishlist successfully!']);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withErrors($e->getMessage());
        }
    }

}
