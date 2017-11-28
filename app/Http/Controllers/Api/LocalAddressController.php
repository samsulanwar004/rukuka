<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\LocalAddressRepository;

class LocalAddressController extends BaseApiController
{
    public function getAllCountry()
    {
    	$LocalAddressRepository = new LocalAddressRepository;
    	$result = $LocalAddressRepository->processGetAllCountry();

    	return $this->success($result, 200);
    }

    public function getAllProvince()
    {
    	$LocalAddressRepository = new LocalAddressRepository;
    	$result = $LocalAddressRepository->processGetAllProvince();

    	return $this->success($result, 200);
    }

    public function getAllCity($byProvince=null)
    {
    	$LocalAddressRepository = new LocalAddressRepository;
    	$result = $LocalAddressRepository->processGetAllCity($byProvince);

    	return $this->success($result, 200);
    }

    public function getSubDistrict($byCity=null)
    {
    	$LocalAddressRepository = new LocalAddressRepository;
    	$result = $LocalAddressRepository->processGetAllSubDistrict($byCity);

    	return $this->success($result, 200);
    }

    public function getVillage($bySubDistrict){

    	$LocalAddressRepository = new LocalAddressRepository;
    	$result = $LocalAddressRepository->processGetAllVillage($bySubDistrict);

    	return $this->success($result, 200);

    }
    
}
