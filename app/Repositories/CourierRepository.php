<?php

namespace App\Repositories;

use App\Services\PosIndonesiaCourierService;
use Symfony\Component\HttpFoundation\Session\Session;

use DB;
use Exception;
use Cache;

class CourierRepository{

	const POS_INDONESIA = 'posindonesiacourier';

	private $checkoutBag;
	private $destinationAddress;

	public function setCheckoutBag($bag){

		$this->checkoutBag = $bag;
		return $this;

	}

	public function setDestinationAddress($destinationAddress){

		$this->destinationAddress = $destinationAddress;
		return $this;

	}

	public function getAvailableCouriers(){

		return [
				'available_couriers' => [
					self::POS_INDONESIA => $this->getShippingServiceByPosIndonesia(),
				]	
		];

	}

	public function getShippingServiceByPosIndonesia(){
		
		$posIndonesia 		= new PosIndonesiaCourierService;
		$checkoutBag 		= $this->checkoutBag;
		$destinationAddress = $this->destinationAddress;

		// simple validation bag and destination
		if ($destinationAddress == null || count($destinationAddress) == 0) {

			return $this->formatResponse('1', 'destination address is empty', null);

		}else if($checkoutBag == null || count($checkoutBag) == 0){

			return $this->formatResponse('2', 'checkout bag is empty', null);

		}

		// check destination
		if ($destinationAddress->country == 'ID') {

			$requestIsDomestic = 1;
			$requesReceiverPosCode = $destinationAddress->postal;

		}else{

			$requestIsDomestic = 0;
			$requesReceiverPosCode = $destinationAddress->country;
		}

		// init count dimension
		$requestWeight 		= 0;
		$requestLength 		= 0;
		$requestWidth 		= 0;
		$requestHeight 		= 0;
		$requestDiameter 	= 0;
		$requestItemValue	= 0;

		foreach ($checkoutBag as $checkoutBag_key => $checkoutBag_value) {
			
			$requestWeight 		+= $checkoutBag_value->options->weight * $checkoutBag_value->qty;
			$requestLength 		+= $checkoutBag_value->options->length * $checkoutBag_value->qty;
			$requestWidth 		+= $checkoutBag_value->options->width * $checkoutBag_value->qty;
			$requestHeight 		+= $checkoutBag_value->options->height * $checkoutBag_value->qty;
			$requestDiameter 	+= $checkoutBag_value->options->diameter * $checkoutBag_value->qty;
			$requestItemValue	+= $checkoutBag_value->price * $checkoutBag_value->qty;

		}

		//create request getfee
	    $requestToPosIndonesia = [
	                                [
	                                    'userId'            => config('common.username_pos_indonesia'),
	                                    'password'          => config('common.password_pos_indonesia'),
	                                    'customerId'        => '',
	                                    'isDomestic'        => $requestIsDomestic,
	                                    'senderPosCode'     => '13210',
	                                    'receiverPosCode'   => $requesReceiverPosCode,
	                                    'weight'            => $requestWeight,
	                                    'length'            => $requestLength,
	                                    'width'             => $requestWidth,
	                                    'height'            => $requestHeight,
	                                    'diameter'          => $requestDiameter,
	                                    'itemValue'         => $requestItemValue
	                                ]
	                            ];

	    $resultPosIndonesia = $posIndonesia->callMethod('getFee', $requestToPosIndonesia);
	    // $resultPosIndonesia = null;

	    if ($resultPosIndonesia->r_fee->serviceName == 'ERROR') {
	    	
	    	return $this->formatResponse('999', 'Shiping services unavailable', $resultPosIndonesia);
	    
	    }else if ($resultPosIndonesia->r_fee->serviceName == 'NOT FOUND'){
	    	
	    	return $this->formatResponse('999', 'Shiping services unavailable', $resultPosIndonesia);
	    
	    }else{

	    	$this->saveResultShippingCostService(self::POS_INDONESIA, $resultPosIndonesia->r_fee);
	    	return $this->formatResponse('000', 'success', $resultPosIndonesia->r_fee);
	    
	    }

	}

	public function saveResultShippingCostService($courierName, $result){

		$session = new Session();
		
		if ($session->has('last_courier_available') == false) {

			$add_courier_available[$courierName] = $result; 
			$session->set('last_courier_available', $add_courier_available);
			
			return true;

		}else{
			
			$update_courier_available = $session->get('last_courier_available');
			
			unset($update_courier_available[$courierName]);
			$update_courier_available[$courierName] = $result;
			
			$session->remove('last_courier_available');
			$session->set('last_courier_available', $update_courier_available);

			return true;
		}

	}

	public function getShippingCostChoosed($valueChoosed){

		$session = new Session();

		$params = explode('-choose-', $valueChoosed);

		$listCost = $session->get('last_courier_available')[ $params[0] ];

		if ($params[0] == self::POS_INDONESIA) {

			foreach ($listCost as $listCostKey => $listCostValue) {
				
				if ($listCostValue->serviceCode == $params[1]) {

					return $this->formatResponse('000', 'success , Courier name ' . $params[0] . ' and choose ' . $params[1] . ' shipping cost in data', $listCostValue);

				}

			}

			return $this->formatResponse('000', 'last courier avaiable not found', null);

		}else{

			return $this->formatResponse('000', 'last courier avaiable not found', null);

		}
	}

	public function formatResponse($erroCode, $message, $data){

		return [
			'error'	=>	$erroCode, 
			'message' => $message,
			'data' => $data
		];

	}

	
}