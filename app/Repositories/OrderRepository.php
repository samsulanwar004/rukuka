<?php

namespace App\Repositories;

use App\Order;
use App\OrderDetail;
use App\Repositories\CourierRepository;
use App\Repositories\UserRepository;

class OrderRepository
{
	private $orderCode;
	private $user;
	private $paymentMethod;
	private $paymentName;
	private $paymentStatus;
	private $paymentValidationStatus;
	private $orderSubtotal;
	private $orderSubtotalAfterDiscount;
	private $orderSubtotalAfterCoupon;
	private $shipping;
	private $shippingCost;
	private $orderStatus;
	private $cancelReason;
	private $pendingReason;
	private $orderDate;
	private $expiredDate;
	private $detail;

    public function setUserEmail($value)
    {
        $this->user = $value;

        return $this;
    }

    public function getUserEmail()
    {
        return $this->user;
    }

	public function setOrderCode($value)
	{
		$this->orderCode = $value;

		return $this;
	}

	public function getOrderCode()
	{
		return $this->orderCode;
	}

	public function setUser($value)
	{
		$this->user = $value;

		return $this;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function setPaymentMethod($value)
	{
		$this->paymentMethod = $value;

		return $this;
	}

	public function getPaymentMethod()
	{
		return $this->paymentMethod;
	}

	public function setPaymentName($value)
	{
		$this->paymentName = $value;

		return $this;
	}

	public function getPaymentName()
	{
		return $this->paymentName;
	}

	public function setPaymentStatus($value)
	{
		$this->paymentStatus = $value;

		return $this;
	}

	public function getPaymentStatus()
	{
		return $this->paymentStatus;
	}

	public function setPaymentValidationStatus($value)
	{
		$this->paymentValidationStatus = $value;

		return $this;
	}

	public function getPaymentValidationStatus()
	{
		return $this->paymentValidationStatus;
	}

	public function setOrderSubtotal($value)
	{
		$this->orderSubtotal = $value;

		return $this;
	}

	public function getOrderSubtotal()
	{
		return $this->orderSubtotal;
	}

	public function setOrderSubtotalAfterDiscount($value)
	{
		$this->orderSubtotalAfterDiscount = $value;

		return $this;
	}

	public function getOrderSubtotalAfterDiscount()
	{
		return $this->orderSubtotalAfterDiscount;
	}

	public function setOrderSubtotalAfterCoupon($value)
	{
		$this->orderSubtotalAfterCoupon = $value;

		return $this;
	}

	public function getOrderSubtotalAfterCoupon()
	{
		return $this->orderSubtotalAfterCoupon;
	}

	public function setShipping($value)
	{
		$this->shipping = $value;

		return $this;
	}

	public function getShipping()
	{
		return $this->shipping;
	}

	public function setShippingCost($value)
	{
		$this->shippingCost = $value;

		return $this;
	}

	public function getShippingCost()
	{
		return $this->shippingCost;
	}

	public function setOrderStatus($value)
	{
		$this->orderStatus = $value;

		return $this;
	}

	public function getOrderStatus()
	{
		return $this->orderStatus;
	}

	public function setCancelReason($value)
	{
		$this->cancelReason = $value;

		return $this;
	}

	public function getCancelReason()
	{
		return $this->cancelReason;
	}

	public function setPendingReason($value)
	{
		$this->pendingReason = $value;

		return $this;
	}

	public function getPendingReason()
	{
		return $this->pendingReason;
	}

	public function setOrderDate($value)
	{
		$this->orderDate = $value;

		return $this;
	}

	public function getOrderDate()
	{
		return $this->orderDate;
	}

	public function setExpiredDate($value)
	{
		$this->expiredDate = $value;

		return $this;
	}

	public function getExpiredDate()
	{
		return $this->expiredDate;
	}

	public function setDetail($value)
	{
		$this->detail = $value;

		return $this;
	}

	public function getDetail()
	{
		return $this->detail;
	}

	public function setPayment($value)
	{
		$this->payment = $value;

		return $this;
	}

	public function getPayment()
	{
		return $this->payment;
	}

	public function save()
	{
		$order = new Order;
		$order->order_code = $this->getOrderCode();    	
    	$order->payment_method = $this->getPaymentMethod();
    	$order->payment_name = $this->getPaymentName();
    	$order->order_subtotal = $this->getOrderSubtotal();
    	$order->order_subtotal_after_discount = $this->getOrderSubtotalAfterDiscount();
    	$order->order_subtotal_after_coupon = $this->getOrderSubtotalAfterCoupon();
    	
    	$order->shipping_cost = $this->getShippingCost();
    	$order->pending_reason = $this->getPendingReason();
    	$order->order_date = $this->getOrderDate();
    	$order->expired_date = $this->getExpiredDate();

    	$order->user()->associate($this->getUser());
    	$order->address()->associate($this->getShipping());
    	$order->creditcard()->associate($this->getPayment());

    	$order->save();

    	foreach ($this->getDetail() as $detail) {

    		$subtotal = $detail['qty'] * $detail['price'];
    		$orderDetail = new OrderDetail;
    		$orderDetail->product_code = $detail['product_code'];
    		$orderDetail->product_name = $detail['product_name'];
    		$orderDetail->sku = $detail['sku'];
    		$orderDetail->qty = $detail['qty'];
    		$orderDetail->price = $detail['price'];
    		$orderDetail->subtotal = $subtotal;

    		$orderDetail->order()->associate($order);
    		$orderDetail->productStock()->associate($detail['product_stocks_id']);

    		$orderDetail->save();
    	}

    	return $order;
	}

	public function getOrderById($id)
	{
		return Order::where('id', $id)
			->first();
	}

	public function getTrackingAirwaybill(){
		
		$order = Order::with('user')
						->with('address')
						->where('order_code', $this->getOrderCode())
						->first();

		// check order
		if ($order == null) {
			
			return (new CourierRepository)->formatResponse('806', 'Order not found', null, null);
		
		}else if ($order->airwaybill == null) {
			
			return (new CourierRepository)->formatResponse('801', 'Airwaybill code not available in your order please contact customer sevice', null, null);
		
		}

		//get airwaybill ems info
		$resultTracking = (new CourierRepository)->getTrackingAndTracePosIndonesia($order->airwaybill);
		
		$data = [
			'tracking' => $resultTracking['data'],
			'order' => $order
		];

		return 	(new CourierRepository)->formatResponse($resultTracking['error'], $resultTracking['message'], $data, null);
		
	}

	public function getTrackingOrder(){
        $order = Order::with('user')
            ->with('address')
            ->join('users', 'orders.users_id', '=', 'users.id')
            ->where('users.email', $this->getUserEmail())
            ->where('order_code', $this->getOrderCode())
            ->first();

        // check order code status and airwaybill
        if ($order == null) {

            return (new CourierRepository)->formatResponse('806', 'Order not found', null, null);

        }else if ($order->payment_status == 0 && $order->order_status == 0) {

            $userData = (new UserRepository)->getUserByEmail($this->getUserEmail());

            $userData =  [
                'id' => $userData->id,
                'email' => $userData->email
            ];

            session()->put('as.guest', $userData);

            return (new CourierRepository)->formatResponse('100', 'Please finish your payment before payment is expired', $order, null);

        }else if ($order->airwaybill == null) {

            return (new CourierRepository)->formatResponse('801', 'Airwaybill code not available in your order please contact customer service', null, null);
        }

        //get airwaybill ems info
        $resultTracking = (new CourierRepository)->getTrackingAndTracePosIndonesia($order->airwaybill);

        $data = [
            'tracking' => $resultTracking['data'],
            'order' => $order
        ];

        return 	(new CourierRepository)->formatResponse($resultTracking['error'], $resultTracking['message'], $data, null);
    }

	public function getOrderbyOrderCode($code){
        return Order::where('order_code', $code)
            ->first();
    }
}