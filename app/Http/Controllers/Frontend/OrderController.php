<?php

namespace App\Http\Controllers\Frontend;

use App\OrderDetail;
use App\Order;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Services\BagService;
use App\Services\EmailService;
use App\Services\CurrencyService;
use App\Repositories\UserRepository;
use App\Repositories\CourierRepository;
use App\Repositories\PaymentRepository;
use DB;
use Carbon\Carbon;
use Exception;
use Validator;

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

            $address = $this->user
            ->setUser($user)
            ->getAddressDefault();


	        $bags = $bag->get(self::INSTANCE_SHOP);

	        $total = str_replace(',', '', $bag->subtotal());

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
	        		'product_photo' => $entry->options->photo,
	        		'size' => $entry->options->size,
	        	];
	        });

	        $shipping = $courir['data']->total_fee_idr;

	        $orderDate = Carbon::now();
	        $expiredDate = Carbon::now()->addDay();

	        $payment = new CurrencyService;
			$kurs  = $payment->getCurrentCurrency();
            $totalwithshipping = $total+$shipping;

	        $secret = config('common.order_key_signature');
	        $signature = sha1($totalwithshipping.$secret);
	        $message = 'Waiting for payment';
	        $orderCode = $this->generateOrderCode();

	        $order = $this->order
	        	->setOrderCode($orderCode)
	        	->setUser($user)
	        	->setPaymentMethod('creditcard')
	        	->setPaymentName($address->first_name)
	        	->setOrderSubtotal($total)
	        	->setOrderSubtotalAfterDiscount($total)
	        	->setOrderSubtotalAfterCoupon($total)
	        	->setShipping($address)
	        	// ->setPayment($creditCard)
	        	->setShippingCost($shipping)
	        	->setPendingReason($message)
	        	->setOrderDate($orderDate)
	        	->setExpiredDate($expiredDate)
	        	->setDetail($detail)
	        	->save();

            //EMAILSENT
			//sent invoice unpaid to buyer
              $emailService = (new EmailService);
              $emailService->sendInvoiceUnpaid($order);

             //notification
             //create notification
	        $users = config('common.admin.users_id');
	        $module = 'orders';
	        (new PaymentRepository)->notificationforAdmin($users, $orderCode.' '.$message, $module);

            DB::commit();
			return view('pages.checkout.checkout_finish', compact(
				'order', 
				'detail', 
				'total', 
				'shipping',
				'signature',
				'kurs',
				'repayment',
				'totalwithshipping'
			));

		} catch (Exception $e) {
			DB::rollBack();

			return redirect('/bag')->withErrors($e->getMessage());
		}
	}

	public function restore(Request $request)
	{   
		try
		{
			$data = $request->all();
			$order_id = $data['order_code'];
			$signature1 = $data['signature'];
			$signature2 = sha1($order_id);
			if ($signature1 != $signature2) 
			{
	         	throw new Exception("access denied.", 1);	
	        }

            $data_order = Order::where('order_code',$order_id) ->first();
			 			   
			if (!isset($data_order->order_code)) {
				throw new Exception("order code not found.", 1);
			}

			if ($data_order->payment_status != 0) {
				throw new Exception("order already paid.", 1);
			}

			$total = $data_order->order_subtotal_after_coupon;
			$shipping = $data_order->shipping_cost;
	        $payment = new CurrencyService;
			$kurs  = $payment->getCurrentCurrency();
	        $totalwithshipping = $total+$shipping;
	        $secret = config('common.order_key_signature');
            $signature = sha1($totalwithshipping.$secret);

	        $order = (object) array('order_code' => $data_order->order_code,'users_id' => $data_order->users_id);

            $detail = OrderDetail::where('orders_id',$data_order->id)->get();

			$detail = $detail->map(function ($entry) use ($detail){
	        	return [
	        		'sku' => $entry->id,
	        		'qty' => $entry->qty,
	        		'product_name' => $entry->product_name,
	        		'price' => $entry->price,
	        		'product_id' => $entry->product_stocks_id,
	        		'product_code' => $entry->product_code,
	        		'product_stocks_id' => $entry->product_stocks_id,
                    'size'  =>  $entry->productStock->size,
	        	];
	        });	   

	        $year = intval(date('Y'));
	        $repayment = 1;
			
			return view('pages.checkout.checkout_finish', compact( 
				'year',
				'order',
				'detail', 
				'total', 
				'shipping',
				'signature',
				'repayment',
				'kurs',
				'totalwithshipping'
			));

		
		} catch (Exception $e) {

			return redirect('/account/history')->withErrors($e->getMessage());
		}
	}
	
	public function trackingTrace($ordeCode){

		$tracking = $this->order
                    ->setOrderCode($ordeCode)
                    ->setUser($this->getUserActive())
                    ->getTrackingAirwaybill();
			
		return view('pages.tracking_ems', compact('tracking'));
	}

	public function trackingOrder(){
        if(auth()->check()){
            return redirect('/account/history');
        }
        //delete session as guest
        session()->forget('as.guest');
		return view('pages.tracking_order_index');
	
	}

	public function trackingOrderCode(Request $request){

	    if($request->method() == 'GET'){
            return redirect()->route('tracking-page');
        }

        $tracking = $this->order
                    ->setOrderCode($request->input('order_code'))
                    ->setUserEmail($request->input('email'))
                    ->getTrackingOrder();

        $exchange = (new CurrencyService)->getCurrentCurrency();

		return view('pages.tracking_order_status', compact('tracking','exchange'));

	}

	public function generateOrderCode(){
	    $order_code = date('ym').rand(1000,9999);
        $validator = \Validator::make(['order_code'=>$order_code],['order_code'=>'unique:orders,order_code']);

        if($validator->fails()){
            $this->generateProductDate();
        }
	    return $order_code;
    }
}
