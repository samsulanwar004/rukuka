<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\LocalAddressRepository;

class LocalAddressController extends BaseApiController
{
    public function getAllCountry()
    {
    	$LocalAddressRepository = new LocalAddressRepository;
    	$countries = $LocalAddressRepository->processGetAllCountry();

    	return $this->success($countries, 200);
    }
    
}
