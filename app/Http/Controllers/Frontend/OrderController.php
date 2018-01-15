<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Services\BagService;
use App\Repositories\UserRepository;
use App\Repositories\CourierRepository;
use DB;
use Carbon\Carbon;
use Exception;

class OrderController extends BaseController
{
	const INSTANCE_SHOP = 'shopping';
	private $order;
	private $user;

	public function __construct(OrderRepository $order, UserRepository $user)
	{
		$this->order = $order;
		$this->user = $user;
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'order' => 'required'
		]);

		try {
			DB::beginTransaction();
			$user = $this->getUserActive();
			$bag = new BagService;

			// $creditCard = $this->user
   //          ->setUser($user)
   //          ->getCreditCardDefault();

            $address = $this->user
            ->setUser($user)
            ->getAddressDefault();

	        $bags = $bag->get(self::INSTANCE_SHOP);

	        $total = $bag->subtotal();

	        if (!count($bags)) {
	        	throw new Exception("Bags is empty!", 1);
	        }

	        $courir = (new CourierRepository)->getSavedSessionShippingChoosed();

	        if ($courir['error'] != "000") {
	        	throw new Exception($courir['message'], 1);	
	        }

	        $detail = $bags->map(function ($entry) use ($bag){
	        	$bag->remove($entry->rowId);
	        	return [
	        		'sku' => $entry->id,
	        		'qty' => $entry->qty,
	        		'product_name' => $entry->name,
	        		'price' => $entry->price,
	        		'product_id' => $entry->options->product_id,
	        		'product_code' => $entry->options->product_code,
	        		'product_stocks_id' => $entry->options->product_stocks_id,
	        	];
	        });	        

	        $shipping = $courir['data']->total_fee_usd;
	        //$shipping = 50;

	        $orderDate = Carbon::now();
	        $expiredDate = Carbon::now()->addDay();
	        $rupiah =DB::table('exchange_rates')->select('conversion_value')->get()->last();
	        $rupiah = $rupiah->conversion_value; // nanti dari database diedit admin
	        $totalwithshipping = ($total+$shipping)*$rupiah;
	        $secret = config('common.order_key_signature');
	        $signature = sha1($totalwithshipping.$secret);

	        $order = $this->order
	        	->setOrderCode('ON'.date('YmdHis').rand(000,999))
	        	->setUser($user)
	        	->setPaymentMethod('creditcard')
	        	->setPaymentName($address->first_name)
	        	->setOrderSubtotal($total)
	        	->setOrderSubtotalAfterDiscount($total)
	        	->setOrderSubtotalAfterCoupon($total)
	        	->setShipping($address)
	        	// ->setPayment($creditCard)
	        	->setShippingCost($shipping)
	        	->setPendingReason('Waiting for payment')
	        	->setOrderDate($orderDate)
	        	->setExpiredDate($expiredDate)
	        	->setDetail($detail)
	        	->save();

			DB::commit();

			return view('pages.checkout.checkout_finish', compact(
				'order', 
				'detail', 
				'total', 
				'shipping',
				'rupiah',
				'signature',
				'$totalwithshipping'
			));

		} catch (Exception $e) {
			DB::rollBack();

			return redirect('/bag')->withErrors($e->getMessage());
		}
	}
}
