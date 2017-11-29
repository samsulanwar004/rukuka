<?php

namespace App\Services;

use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;

class PosIndonesiaCourierService
{
	private function getTemplateWSDL($wsdlPath)
	{
	    return (new Factory())->create(new Client(), $wsdlPath);
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
	    $this->getTemplateWSDL(config('common.wsdl_pos_indonesia'))->call($method, $requestToPosIndonesia);
	}
}