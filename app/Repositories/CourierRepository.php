<?php

namespace App\Repositories;

use App\Services\PosIndonesiaCourierService;
use App\Services\BagService;
use App\Services\CurrencyService;

use Symfony\Component\HttpFoundation\Session\Session;

use DB;
use Exception;
use Cache;

use App\ExchangeRate;

class CourierRepository{

	const POS_INDONESIA 		 = 'pos_indonesia';
	const CHOOSED_SEPARATOR 	 = '-choosed-';
	const LAST_COURIER_AVAILABLE = 'last_courier_available';
	const LAST_COURIER_CHOOSED 	 = 'last_courier_choosed';
	const SIGNATURE_BAG			 = 'signature_bag';
	const SIGNATURE_ADDRESS		 = 'signature_address';

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
		$this->createSignatureAddress();

		return [
				'available_couriers' => [
					self::POS_INDONESIA => $this->getShippingServiceByPosIndonesia(),
				]	
		];

	}

	private function createSignatureBag(){

		$session = new Session();

		$signatureResult = $this->getSignatureBag();

		if ($signatureResult['error'] != '000') {

			return $signatureResult;
		
		}

		$session->remove(self::SIGNATURE_BAG);
		$session->set(self::SIGNATURE_BAG, $signatureResult['data']);

		return $this->formatResponse('000', 'signature bag created',  $signatureResult['data'], null);
	}

	private function verifySignatureBag(){

		$session = new Session();

		$signatureResult = $this->getSignatureBag();

		if ($signatureResult['error'] != '000') {

			return $signatureResult;
		
		}

		if ($session->get(self::SIGNATURE_BAG) == null) {

			return $this->formatResponse('990', 'signature bag in session not found', null, null);
		
		}else if ($session->get(self::SIGNATURE_BAG) == $signatureResult['data']) {

			return $this->formatResponse('000', 'success signature bag valid', null, null);
		
		}else{

			return $this->formatResponse('989', 'error signature invalid, bag already changed please reselect shipping cost', null, null);

		}
		
	}

	private function getSignatureBag(){

		$checkoutBag = $this->checkoutBag;

		if($checkoutBag == null || count($checkoutBag) == 0){

			return $this->formatResponse('991', 'checkout bag is empty', null, null);

		}

		// init count dimension
		$requestWeight 		= '';
		$requestLength 		= '';
		$requestWidth 		= '';
		$requestHeight 		= '';
		$requestDiameter 	= '';
		$requestItemValue	= '';

		foreach ($checkoutBag as $checkoutBag_key => $checkoutBag_value) {
			
			$requestWeight 		.= $checkoutBag_value->options->weight . $checkoutBag_value->qty . $checkoutBag_value->id . $checkoutBag_value->rowId;
			$requestLength 		.= $checkoutBag_value->options->length . $checkoutBag_value->qty . $checkoutBag_value->id . $checkoutBag_value->rowId;
			$requestWidth 		.= $checkoutBag_value->options->width . $checkoutBag_value->qty . $checkoutBag_value->id . $checkoutBag_value->rowId;
			$requestHeight 		.= $checkoutBag_value->options->height . $checkoutBag_value->qty . $checkoutBag_value->id . $checkoutBag_value->rowId;
			$requestDiameter 	.= $checkoutBag_value->options->diameter . $checkoutBag_value->qty . $checkoutBag_value->id . $checkoutBag_value->rowId;
			$requestItemValue	.= $checkoutBag_value->price . $checkoutBag_value->qty . $checkoutBag_value->id . $checkoutBag_value->rowId;

		}

		$signatureData = $requestWeight . $requestLength . $requestWidth . $requestHeight . $requestItemValue;
		$signatureResult = md5($signatureData);

		return $this->formatResponse('000', 'bring signature bag in data', $signatureResult, null);
	}

	private function createSignatureAddress(){

		$session = new Session();

		$signatureResult = $this->getSignatureAddress();

		if ($signatureResult['error'] != '000') {

			return $signatureResult;
		
		}

		$session->remove(self::SIGNATURE_ADDRESS);
		$session->set(self::SIGNATURE_ADDRESS, $signatureResult['data']);

		return $this->formatResponse('000', 'signature bag created',  $signatureResult['data'], null);

	}

	private function veryfySignatureAddress(){

		$session = new Session();

		$signatureResult = $this->getSignatureAddress();

		if ($signatureResult['error'] != '000') {

			return $signatureResult;
		
		}		

		if ($session->get(self::SIGNATURE_ADDRESS) == null) {

			return $this->formatResponse('990', 'signature address in session not found', null, null);
		
		}else if ($session->get(self::SIGNATURE_ADDRESS) == $signatureResult['data']) {

			return $this->formatResponse('000', 'success signature address valid', null, null);
		
		}else{

			return $this->formatResponse('989', 'error signature invalid, address already changed please reselect shipping cost', null, null);

		}
	}

	private function getSignatureAddress(){

		$destinationAddress = $this->destinationAddress;

		if ($destinationAddress == null || count($destinationAddress) == 0) {

			return $this->formatResponse('990', 'destination address is empty', null, null);

		}

		$signatureData =  $destinationAddress->id .
						  $destinationAddress->users_id .
						  $destinationAddress->first_name .
						  $destinationAddress->last_name .
						  $destinationAddress->company .
						  $destinationAddress->address_line .
						  $destinationAddress->city .
						  $destinationAddress->province .
						  $destinationAddress->postal .
						  $destinationAddress->country .
						  $destinationAddress->phone_number .
						  $destinationAddress->is_default .
						  $destinationAddress->created_at .
						  $destinationAddress->updated_at .
						  $destinationAddress->sub_district .
						  $destinationAddress->village;

		$signatureResult = md5($signatureData);

		return $this->formatResponse('000', 'bring signature address in data', $signatureResult, null);
	}

	public function getTrackingAndTracePosIndonesia($airwayBillNumber){
		
		$posIndonesia = new PosIndonesiaCourierService;

		if(config('common.is_pos_indonesia_prod') == true){

			$requestUserId = config('common.username_pos_indonesia_prod');
			$requestPassword = config('common.password_pos_indonesia_prod');
		
		}else{

			$requestUserId = config('common.username_pos_indonesia_dev');
			$requestPassword = config('common.password_pos_indonesia_dev');

		}

		//create request getfee
	    $requestToPosIndonesia = [
	                                [
	                                    'userId'  	=> $requestUserId,
	                                    'password'  => $requestPassword,
	                                    'barcode'   => $airwayBillNumber,
	                                ]
	                            ]; 
	    
	    $resultPosIndonesia = $posIndonesia->callMethod('getTrackAndTrace', $requestToPosIndonesia);
		
		// for testing and debug
	    $requestToPosIndonesia[0]['userId'] = '';
	    $requestToPosIndonesia[0]['password'] = '';
	    echo "<script>console.log('" . json_encode($requestToPosIndonesia) . "');</script>";
		echo "<script>console.log('" . json_encode($resultPosIndonesia) . "');</script>";

	    if ($resultPosIndonesia == null) {

	    	return $this->formatResponse('802', 'error track and trace services unavailable', $resultPosIndonesia, null);
	    
	    }else if (count($resultPosIndonesia->r_tnt) == 0) {
	    	
	    	return $this->formatResponse('804', 'Tracking result not found', $resultPosIndonesia, null);
	    }

	    return $this->formatResponse('000', 'this is result of track and trace', $resultPosIndonesia->r_tnt, null);
	}

	private function getShippingServiceByPosIndonesia(){
		
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

		if(config('common.is_pos_indonesia_prod') == true){

			$requestUserId = config('common.username_pos_indonesia_prod');
			$requestPassword = config('common.password_pos_indonesia_prod');
		
		}else{

			$requestUserId = config('common.username_pos_indonesia_dev');
			$requestPassword = config('common.password_pos_indonesia_dev');

		}

		//create request getfee
	    $requestToPosIndonesia = [
	                                [
	                                    'userId'            => $requestUserId,
	                                    'password'          => $requestPassword,
	                                    'customerId'        => '',
	                                    'isDomestic'        => $requestIsDomestic,
	                                    'senderPosCode'     => config('common.sender_pos_code'),
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
		
		// for testing and debug
	    $requestToPosIndonesia[0]['userId'] = '';
	    $requestToPosIndonesia[0]['password'] = '';
	    echo "<script>console.log('" . json_encode($requestToPosIndonesia) . "');</script>";
		echo "<script>console.log('" . json_encode($resultPosIndonesia) . "');</script>";

	    if ($resultPosIndonesia->r_fee->serviceName == 'ERROR') {
	    	
	    	return $this->formatResponse('999', 'error shipping cost please contact administrator', $resultPosIndonesia, null);
	    
	    }else if ($resultPosIndonesia->r_fee->serviceName == 'NOT FOUND'){
	    	
	    	return $this->formatResponse('999', 'error shiping services unavailable', $resultPosIndonesia, null);
	    
	    }else{

	    	if (is_array($resultPosIndonesia->r_fee) == false) {
	    		
	    		if ((float) $resultPosIndonesia->r_fee->totalFee > 0 == false) {
	    			
	    			return $this->formatResponse('999', $resultPosIndonesia->r_fee->serviceName, $resultPosIndonesia, null);

	    		}

	    	}

	    	$rebuildResponse = $this->rebuildDataResponseFromProviderShipping(self::POS_INDONESIA, $resultPosIndonesia);
	    	
	    	if ($rebuildResponse['error'] != '000') {
	    		
	    		return $rebuildResponse;

	    	}

	    	$this->saveResultShippingCostService(self::POS_INDONESIA, $rebuildResponse['data']);

	    	return $this->formatResponse('000', 'success', $rebuildResponse['data'], self::CHOOSED_SEPARATOR);
	    
	    }

	}

	private function rebuildDataResponseFromProviderShipping($courierName, $resultFromCourierProvider){

		if ($courierName == self::POS_INDONESIA) {

			// kurensi
			$currency = (new CurrencyService)->getCurrentCurrency();

			if ($currency == null) {
				
				return $this->formatResponse('887', 'error currency rate not set', null, null);

			}else if(is_numeric($currency->value) == false){

				return $this->formatResponse('801', 'error currency is not number', null, null);	
			
			}else if ($currency->value <= 0) {
				
				return $this->formatResponse('822', 'Someting wrong in currency value lower than 0', null, null);

			}

			// reforming structur
			if (is_array($resultFromCourierProvider->r_fee)) {
				
				foreach ($resultFromCourierProvider->r_fee as $resultFromCourierProviderKey => $resultFromCourierProviderValue) {
				
					$listServiceCost[] = $this->defaultTemplateResponseCourier(
											$resultFromCourierProviderValue->serviceCode, 
											$resultFromCourierProviderValue->serviceName, 
											$resultFromCourierProviderValue->fee, 
											$resultFromCourierProviderValue->feeTax, 
											$resultFromCourierProviderValue->insurance, 
											$resultFromCourierProviderValue->insuranceTax, 
											$resultFromCourierProviderValue->totalFee, 
											$resultFromCourierProviderValue->itemValue,
											0,
											self::POS_INDONESIA,
											$currency
										);

				}

			}else{

				$listServiceCost[] = $this->defaultTemplateResponseCourier(
										$resultFromCourierProvider->r_fee->serviceCode, 
										$resultFromCourierProvider->r_fee->serviceName, 
										$resultFromCourierProvider->r_fee->fee, 
										$resultFromCourierProvider->r_fee->feeTax, 
										$resultFromCourierProvider->r_fee->insurance, 
										$resultFromCourierProvider->r_fee->insuranceTax, 
										$resultFromCourierProvider->r_fee->totalFee, 
										$resultFromCourierProvider->r_fee->itemValue,
										0,
										self::POS_INDONESIA,
										$currency
									);

			}

			// rewrite label to luar negri
			$rewriteLabel['010'] =  array('mark' => 'R LN ', 'replace' => 'letter service ');
			$rewriteLabel['312'] =  array('mark' => 'EMS BARANG ', 'replace' => 'Express service');
			$rewriteLabel['331'] =  array('mark' => 'PAKETPOS CEPAT LN ', 'replace' => 'Quick service ');
			$rewriteLabel['332'] =  array('mark' => 'PAKETPOS BIASA LN ', 'replace' => 'Normal service ');

			// rewrite label to lokal destination
			$rewriteLabel['240'] =  array('mark' => 'PAKET KILAT KHUSUS ', 'replace' => 'SPECIAL PACKAGE ');
			$rewriteLabel['PDG'] =  array('mark' => 'PAKETPOS DANGEROUS GOODS ', 'replace' => 'PACKAGE DANGEROUS GOODS ');
			$rewriteLabel['PVG'] =  array('mark' => 'PAKET KILAT KHUSUS ', 'replace' => 'SPECIAL PACKAGE (kilat khusus) ');

			foreach ($listServiceCost as $listServiceCostKey => $listServiceCostValue) {
				
				$listServiceCost[$listServiceCostKey]->serviceName = str_replace(
																		$rewriteLabel[$listServiceCostValue->serviceCode]['mark'],  
																		$rewriteLabel[$listServiceCostValue->serviceCode]['replace'],
																		$listServiceCost[$listServiceCostKey]->serviceName
																	);

				$listServiceCost[$listServiceCostKey]->serviceName = str_replace(
																			'HARI', 
																			'DAYS', 
																			$listServiceCost[$listServiceCostKey]->serviceName
																	);

				$listServiceCost[$listServiceCostKey]->serviceName = str_replace(
																			'JAM', 
																			'HOURS', 
																			$listServiceCost[$listServiceCostKey]->serviceName
																	);

			}

			// blacklist service
			$blackList = [
				'010' => 'R LN '
			];

			foreach ($listServiceCost as $listServiceCostKey => $listServiceCostValue) {
				
				if (array_key_exists($listServiceCostValue->serviceCode, $blackList) == true) {
					
					unset($listServiceCost[$listServiceCostKey]);

				}	
			}

			return $this->formatResponse('000', 'success rebuild data response from provider shipping', $listServiceCost, null);

		}else{

			return $this->formatResponse('998', 'error cannot rebuild data response from provider shipping', null, null);

		}

	}

	private function defaultTemplateResponseCourier($serviceCode, $serviceName, $fee, $feeTax, $insurance, $insuranceTax, $totalFee, $itemValue, $totalFeeDollar, $courierName, $currency){
			
		return (object) [
					'serviceCode' 	=> $serviceCode,
					'serviceName' 	=> $serviceName,
					'fee' 			=> $fee,
					'feeTax' 		=> $feeTax,
					'insurance' 	=> $insurance,
					'insuranceTax' 	=> $insuranceTax,
					'totalFeeIdr' 	=> $totalFee,
					'itemValue' 	=> $itemValue,
					'totalFeeDollar'=> $totalFeeDollar,
					'optionValue'	=> $courierName . self::CHOOSED_SEPARATOR . $serviceCode,
					'optionCurrencyLabel' => $currency->symbol . ' ' . number_format(($totalFee / $currency->value), 2)

				];
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

	private function saveResultShippingCostService($courierName, $result){

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

	private function getShippingCostChoosed($valueChoosed){

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

		$veryfiAddress = $this->veryfySignatureAddress();

		if ($veryfiAddress['error'] != '000') {
			
			return $veryfiAddress;
		}

		$costChoosed = $this->getShippingCostChoosed($valueChoosed);

		if ($costChoosed['error'] != '000') {

			return $costChoosed;

		}

		$params = explode(self::CHOOSED_SEPARATOR, $valueChoosed);

		if ($params[0] == self::POS_INDONESIA) {

			$rebuildDataForSummary = $this->rebuildDataForSummary(self::POS_INDONESIA, $valueChoosed, $costChoosed);

			if ($rebuildDataForSummary['error'] != '000') {
				
				return $rebuildDataForSummary;

			}

			return $this->saveToSessionShippingCostChoosed($rebuildDataForSummary['data']);

		}else{

			return $this->formatResponse('994', 'error cant save shipping cost with value ' . $valueChoosed, null, null);
		
		}

	}

	private function saveToSessionShippingCostChoosed($rebuildDataForSummary){

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

	private function rebuildDataForSummary($constCourier, $valueChoosed, $costChoosed){

		// NOTE : standar return array for this method follow pos indonesia bellow

		if ($constCourier == self::POS_INDONESIA) {

			if ($costChoosed['data']->totalFeeIdr <= 0) {

				return $this->formatResponse('996', 'error shipping total', null, null);

			}

			$rebuildData = $this->defaultTemplateForSummary(
								'POS INDONESIA', 
								$costChoosed['data']->totalFeeIdr, 
								$costChoosed['data']->totalFeeDollar, 
								$valueChoosed, 
								$costChoosed['data']
							);

			return  $this->formatResponse('000', 'success rebuild data for summary', $rebuildData, null);

		}else{

			return $this->formatResponse('993','cannot rebuild not recognized courier service', null, null);
		
		}

	}

	private function defaultTemplateForSummary($courierName, $totalFeeIdr, $totalFeeUsd, $valueCourierSelected, $origin){

		return (object) [
							'courier_name' 			 => $courierName,
							'total_fee_idr' 		 => $totalFeeIdr,
							'total_fee_usd' 		 => $totalFeeUsd,
							'value courier_selected' => $valueCourierSelected,
							'origin' 				 => $origin,
						];

	}

	public function formatResponse($errorCode, $message, $data, $separator){

		return [
			'error'	=>	$errorCode,
			'message' => $message,
			'data' => $data,
			'separator' =>$separator,
		];

	}

	
}