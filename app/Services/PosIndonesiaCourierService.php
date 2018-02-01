<?php

namespace App\Services;

use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;

class PosIndonesiaCourierService
{
	private function getTemplateWSDL($wsdlPath)
	{
		// $client = new Client([
		// 						'defaults' => [
		// 	    					'verify' => 'E:\Xampp_windows_server\php\cacert.pem'
		// 						]
		// 					]);
		
		$client = new Client();

	    return (new Factory())->create($client, $wsdlPath);
	}

	/* 
    | ---------------------------------------------------------------------- 
    | callMethod (send request to pos indonesia)
    | ----------------------------------------------------------------------     
	| @method = diisi method sesuai doc post indonesia contoh 'getFee'
	| @requestToPosIndonesia = array request sesuai documentasi contoh [ ['username'=>'', 'passowrd'=>''] ]
    | 
    */

	public function callMethod($method, $requestToPosIndonesia)
	{
		if(config('common.is_pos_indonesia_prod') == true){

			return $this->getTemplateWSDL(config('common.wsdl_pos_indonesia_prod'))->call($method, $requestToPosIndonesia);
			
		}else{

			return $this->getTemplateWSDL(config('common.wsdl_pos_indonesia_dev'))->call($method, $requestToPosIndonesia);
		
		}

	}
}