<?php

namespace App\Repositories;

use App\Services\PosIndonesiaCourierService;
use App\Services\BagService;
use Symfony\Component\HttpFoundation\Session\Session;

use DB;
use Exception;
use Cache;

class CourierRepository{

	const POS_INDONESIA 		 = 'pos_indonesia';
	const CHOOSED_SEPARATOR 	 = '-choosed-';
	const LAST_COURIER_AVAILABLE = 'last_courier_available';
	const LAST_COURIER_CHOOSED 	 = 'last_courier_choosed';
	const SIGNATURE_BAG			 = 'signature_bag';
	const INSTANCE_SHOP 		 = 'shopping';

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

		$this->createSignatureBag();

		return [
				'available_couriers' => [
					self::POS_INDONESIA => $this->getShippingServiceByPosIndonesia(),
				]	
		];

	}

	public function createSignatureBag(){

		$session = new Session();

		$checkoutBag = $this->checkoutBag;

		if($checkoutBag == null || count($checkoutBag) == 0){

			return $this->formatResponse('991', 'checkout bag is empty', null, null);

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

		$signature = $requestWeight . $requestLength . $requestWidth . $requestHeight . $requestItemValue;
		$signatureResult = md5($signature);

		$session->remove(self::SIGNATURE_BAG);
		$session->set(self::SIGNATURE_BAG, $signatureResult);

		return $this->formatResponse('000', 'signature bag created',  $signatureResult, null);
	}

	public function verifySignatureBag(){

		$session = new Session();

		$checkoutBag = $this->checkoutBag;

		if($checkoutBag == null || count($checkoutBag) == 0){

			return $this->formatResponse('991', 'checkout bag is empty', null, null);

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

		$signature = $requestWeight . $requestLength . $requestWidth . $requestHeight . $requestItemValue;
		$signatureResult = md5($signature);

		if ($session->get(self::SIGNATURE_BAG) == null) {

			return $this->formatResponse('990', 'signature bag not found', null, null);
		
		}else if ($session->get(self::SIGNATURE_BAG) == $signatureResult) {

			return $this->formatResponse('000', 'signature bag valid', null, null);
		
		}else{

			return $this->formatResponse('989', 'signature invalid, bag already changed please reselect shipping cost', null, null);

		}
		
	}

	public function getShippingServiceByPosIndonesia(){
		
		$posIndonesia 		= new PosIndonesiaCourierService;
		$checkoutBag 		= $this->checkoutBag;
		$destinationAddress = $this->destinationAddress;

		// simple validation bag and destination
		if ($destinationAddress == null || count($destinationAddress) == 0) {

			return $this->formatResponse('990', 'destination address is empty', null, null);

		}else if($checkoutBag == null || count($checkoutBag) == 0){

			return $this->formatResponse('991', 'checkout bag is empty', null, null);

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
	    	
	    	return $this->formatResponse('999', 'error shiping services unavailable', $resultPosIndonesia, null);
	    
	    }else if ($resultPosIndonesia->r_fee->serviceName == 'NOT FOUND'){
	    	
	    	return $this->formatResponse('999', 'error shiping services unavailable', $resultPosIndonesia, null);
	    
	    }else{

	    	$this->saveResultShippingCostService(self::POS_INDONESIA, $resultPosIndonesia->r_fee);

	    	return $this->formatResponse('000', 'success', $resultPosIndonesia->r_fee, self::CHOOSED_SEPARATOR);
	    
	    }

	}

	//-------------------------------------------------------------------
	// exmaple parameter for method : saveResultShippingCostService($courierName, $result)
	//-------------------------------------------------------------------
	// $result = [ 
	//				0 => ['servinceName' => 's1', 'cost' => 5000],
	//				1 => ['servinceName' => 's2', 'cost' => 6000], 
	//			];
	//
	// $courierName is value of public const 
	//
	//-------------------------------------------------------------------

	public function saveResultShippingCostService($courierName, $result){

		$session = new Session();
		
		if (is_array($result)) {

			$result = $result;

		}else{

			$result = [$result];

		}

		if ($session->has(self::LAST_COURIER_AVAILABLE) == false) {

			$add_courier_available[$courierName] = $result; 
			$session->set(self::LAST_COURIER_AVAILABLE, $add_courier_available);

			return true;

		}else{

			$update_courier_available = $session->get(self::LAST_COURIER_AVAILABLE);
			
			unset($update_courier_available[$courierName]);
			$update_courier_available[$courierName] = $result;
			
			$session->remove(self::LAST_COURIER_AVAILABLE);
			$session->set(self::LAST_COURIER_AVAILABLE, $update_courier_available);

			return true;
		}

	}

	public function getShippingCostChoosed($valueChoosed){

		$session = new Session();

		$params = explode(self::CHOOSED_SEPARATOR, $valueChoosed);

		$listCost = $session->get(self::LAST_COURIER_AVAILABLE)[$params[0]];

		if ($params[0] == self::POS_INDONESIA) {
			
			foreach ($listCost as $listCostKey => $listCostValue) {
				
				if ($listCostValue->serviceCode == $params[1]) {

					return $this->formatResponse('000', 'success , Courier name ' . $params[0] . ' and choose ' . $params[1] . ' shipping cost in data', $listCostValue, null);

				}

			}

			return $this->formatResponse('998', 'error last courier avaiable not found in queue', null, null);

		}else{

			return $this->formatResponse('999', 'error last courier avaiable not found', null, null);

		}
	}

	public function saveShippingCostChoosed($valueChoosed){

		if ($valueChoosed == null) {

			return $this->formatResponse('997', 'error value choosed is null', null, null);
		
		}

		$veryfiBag = $this->verifySignatureBag();

		if ($veryfiBag['error'] != '000') {
			
			return $veryfiBag;
		}

		$costChoosed = $this->getShippingCostChoosed($valueChoosed);

		if ($costChoosed['error'] != '000') {

			return $costChoosed;

		}

		$params = explode(self::CHOOSED_SEPARATOR, $valueChoosed);

		if ($params[0] == self::POS_INDONESIA) {

			$rebuildDataForSummary = $this->rebuildDataForSummary(self::POS_INDONESIA, $valueChoosed, $costChoosed);

			return $this->saveToSessionShippingCostChoosed($rebuildDataForSummary);

		}else{

			return $this->formatResponse('994', 'error cant save shipping cost with value ' . $valueChoosed, null, null);
		
		}

	}

	public function saveToSessionShippingCostChoosed($rebuildDataForSummary){

		$session = new Session();

		if ($rebuildDataForSummary == null) {
			
			return $this->formatResponse('992', 'error rebuild data is null before saving to session', null, null);

		}

		$session->remove(self::LAST_COURIER_CHOOSED);
		$session->set(self::LAST_COURIER_CHOOSED, $rebuildDataForSummary);
		
		return $this->formatResponse('000', 'saved success', $rebuildDataForSummary, null); 
	
	}

	public function getSavedSessionShippingChoosed(){

		$session = new Session();

		if ($session->has(self::LAST_COURIER_CHOOSED) == null) {

			return $this->formatResponse('991', 'error shipping choosed in session not found', null, null);
		
		}

		return $this->formatResponse('000', 'success shipping cost in data', $session->get('last_courier_choosed'), null, null); 

	}

	public function rebuildDataForSummary($constCourier, $valueChoosed, $costChoosed){

		// NOTE : standar return array for this method follow pos indonesia bellow

		if ($constCourier == self::POS_INDONESIA) {

			if ($costChoosed['data']->totalFee <= 0) {

				return $this->formatResponse('996', 'error shipping total', null, null);

			}

			$rebuildData = [
					'courier_name' 		=> 'POS INDONESIA',
					'total_fee_idr' 	=> $costChoosed['data']->totalFee,
					'total_fee_usd' 	=> $costChoosed['data']->notes,
					'value courier_selected' => $valueChoosed,
					'origin' 			=> $costChoosed['data'],
			];

			return $rebuildData;

		}else{

			return $this->formatResponse('993','cannot rebuild not recognized courier service', null, null);
		
		}

	}

	public function formatResponse($erroCode, $message, $data, $separator){

		return [
			'error'	=>	$erroCode, 
			'message' => $message,
			'data' => $data,
			'separator' =>$separator,
		];

	}

	
}