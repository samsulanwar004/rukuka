<?php

namespace App\Services;

use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;

class PosIndonesiaCourierService
{
	private function getTemplateWSDL()
	{
	    return (new Factory())->create(new Client(), config('common.wsdl_pos_indonesia'));
	}

	/* 
    | ---------------------------------------------------------------------- 
    | get (send request to pos indonesia)
    | ----------------------------------------------------------------------     
	| @method = diisi method sesuai doc post indonesia contoh 'getFee'
	| @requestToPosIndonesia = array request sesuai documentasi contoh [['username'=>'', 'passowrd'=>'']]
    | 
    */

	public function get($method, $requestToPosIndonesia)
	{
	    return $this->getTemplateWSDL()->call($method, $requestToPosIndonesia);
	}
}