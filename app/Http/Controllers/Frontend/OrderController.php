<?php

namespace App\Http\Controllers\Frontend;

use App\OrderDetail;
use App\Order;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Services\BagService;
use App\Services\EmailService;
use App\Services\CurrencyService;
use App\Services\XenditService;
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
			'order' => 'required',
			'payment_method' => 'required'
		]);

		try {
			DB::beginTransaction();
			$user = $this->getUserActive();
			$bag = new BagService;

            $address = $this->user
	            ->setUser($user)
	            ->getAddressDefault();

	        $paymentMethod = $request->input('payment_method');

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
	        $shippingName = $courir['data']->courier_name;
	        $shippingService = $courir['data']->service_name_original;

	        $orderDate = Carbon::now();
	        $expiredDate = Carbon::now()->addDay(3);

	        $payment = new CurrencyService;
			$kurs  = $payment->getCurrentCurrency();
            $totalwithshipping = $total+$shipping;

	        $secret = config('common.order_key_signature');
	        $signature = sha1($totalwithshipping.$secret);
	        $message = 'Waiting for payment';
	        $orderCode = $this->generateOrderCode();

	        //virtual account

	        if ($paymentMethod === 'virtual_account') {
	        	$options['secret_api_key'] = config('common.xendit_secret_key');

		        $xenditPHPClient = new XenditService($options);

		        $externalId = $orderCode;
		        $payerEmail= $user->email;
		        $amount = (int)$total + (int)$shipping;
		        $description = 'Rukuka Pay';

		        $response = $xenditPHPClient->createInvoice($externalId, $amount, $payerEmail, $description);
	        } else {
	        	$response['id'] = null;
	        }

	        $order = $this->order
	        	->setOrderCode($orderCode)
	        	->setUser($user)
	        	->setPaymentMethod($paymentMethod)
	        	->setPaymentName($address->first_name)
	        	->setOrderSubtotal($total)
	        	->setOrderSubtotalAfterDiscount($total)
	        	->setOrderSubtotalAfterCoupon($total)
	        	->setShipping($address)
	        	->setPaymentCode($response['id'])
	        	->setPaymentResponse(json_encode($response))
	        	->setShippingName($shippingName)
	        	->setShippingService($shippingService)
	        	->setShippingCost($shipping)
	        	->setPendingReason($message)
	        	->setOrderDate($orderDate)
	        	->setExpiredDate($expiredDate)
	        	->setDetail($detail)
	        	->save();

             //notification
             //create notification
	        $users = config('common.admin.users_id');
	        $module = 'orders';
	        (new PaymentRepository)->notificationforAdmin($users, $orderCode.' '.$message, $module);

            DB::commit();

            if ($paymentMethod === 'creditcard') {
            	//EMAILSENT
				//sent invoice unpaid to buyer
	            $emailService = (new EmailService);
	            $emailService->sendInvoiceUnpaid($order);

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

            } elseif ($paymentMethod === 'bank_transfer') {
            	//EMAILSENT
				//sent invoice unpaid to buyer
	            $emailService = (new EmailService);
	            $emailService->sendInvoiceUnpaidBankTransfer($order);

            	return view('pages.checkout.checkout_finish_bank_transfer', compact(
					'order', 
					'detail', 
					'total', 
					'shipping',
					'kurs',
					'totalwithshipping'
				));
            } elseif ($paymentMethod === 'virtual_account') {
            	//EMAILSENT
				//sent invoice unpaid to buyer
	            $emailService = (new EmailService);
	            $emailService->sendInvoiceUnpaidBankTransfer($order);

            	return view('pages.checkout.checkout_finish_virtual_account', compact(
					'order', 
					'detail', 
					'total', 
					'shipping',
					'kurs',
					'totalwithshipping',
					'response'
				));
            } 

		} catch (Exception $e) {
			DB::rollBack();

			return redirect('/bag')->withErrors($e->getMessage());
		}
	}

	public function restore(Request $request)
	{   
		$this->validate($request, [
			'order_code' => 'required',
			'payment_method' => 'required',
			'signature' => 'required'
		]);

		try
		{
			$data = $request->all();
			$order_id = $data['order_code'];
			$signature1 = $data['signature'];
			$signature2 = sha1($order_id);
			$paymentMethod = $data['payment_method'];
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

	        //virtual account
	        if ($paymentMethod === 'virtual_account') {
	        	$options['secret_api_key'] = config('common.xendit_secret_key');

		        $xenditPHPClient = new XenditService($options);

		        $response = $xenditPHPClient->getInvoice($data_order->payment_code);
	        }

	        if ($paymentMethod === 'creditcard') {

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

            } elseif ($paymentMethod === 'bank_transfer') {

            	return view('pages.checkout.checkout_finish_bank_transfer', compact(
					'order', 
					'detail', 
					'total', 
					'shipping',
					'kurs',
					'totalwithshipping'
				));
            } elseif ($paymentMethod === 'virtual_account') {

            	return view('pages.checkout.checkout_finish_virtual_account', compact(
					'order', 
					'detail', 
					'total', 
					'shipping',
					'kurs',
					'totalwithshipping',
					'response'
				));
            }
		
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
